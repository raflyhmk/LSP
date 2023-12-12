<?php

namespace App\Http\Controllers;

use App\Models\Medic;
use App\Models\User;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class userController extends Controller
{
    public function profile()
    {
        return view('pages.user.profile');
    }
    public function editProfile(Request $request)
    {
        $request->validate([
            'password' => 'confirmed'
        ]);
        $editProfile = User::find(Auth::user()->id);
        $editProfile->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if ($editProfile) {
            Session::flash('status', 'success');
            Session::flash('message', 'Profile berhasil diperbarui');
            return redirect('/profile');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Profile gagal diperbarui');
            return redirect('/profile');
        }
    }
    public function medicalSupplies(Request $request)
    {
        $cari = $request->cari;
        $allData = 10;
        $medicalSupplies = Medic::where('name', 'LIKE', '%' . $cari . '%')
            ->orWhere('kategori', 'LIKE', '%' . $cari . '%')
            ->paginate($allData);
        return view('pages.user.medicalSupplies', compact('medicalSupplies'));
    }

    public function borrowItem(Request $request)
    {
        $user_id = Auth::user()->id;
        $borrowCount = Borrow::where('user_id', $user_id)->count();

        if ($borrowCount >= 2) {
            return redirect()->back()->with('error', 'Anda hanya dapat meminjam maksimal 2 kali.');
        }

        $borrow = new Borrow();
        $borrow->user_id = $user_id;
        $borrow->medic_id = $request->medic_id;
        $borrow->borrow_date = Carbon::now();
        $borrow->return_date = Carbon::now()->addDays(5);
        $borrow->save();

        return redirect()->back()->with('success', 'Peminjaman berhasil diajukan');
    }
    public function historySupplies()
    {
        $borrows = Borrow::where('user_id', Auth::user()->id)->get();
        return view('pages.user.historyPeminjaman', compact('borrows'));
    }
    public function requestReturn($borrowId)
    {
        $borrow = Borrow::find($borrowId);
        if ($borrow && $borrow->user_id == Auth::id()) {
            $borrow->update(['is_return_requested' => true]);
            return redirect()->back()->with('success', 'Request pengembalian telah dikirim.');
        }
        return redirect()->back()->with('error', 'Tidak dapat melakukan request.');
    }

}
