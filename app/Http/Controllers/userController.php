<?php

namespace App\Http\Controllers;

use App\Models\Medic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class userController extends Controller
{
    public function profile(){
        return view('pages.user.profile');
    }
    public function editProfile(Request $request){
        $request->validate([
            'password' => 'confirmed'
        ]);
        $editProfile = User::find(Auth::user()->id);
        $editProfile->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if($editProfile){
            Session::flash('status', 'success');
            Session::flash('message', 'Profile berhasil diperbarui');
            return redirect('/profile');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Profile gagal diperbarui');
            return redirect('/profile');
        }
    }
    public function medicalSupplies(Request $request){
        $cari = $request->cari;
        $allData = 10;
        $medicalSupplies = Medic::where('name', 'LIKE', '%'. $cari. '%')
        ->orWhere('kategori', $cari)
        ->paginate($allData);
        return view('pages.user.medicalSupplies', compact('medicalSupplies'));
    }
}
