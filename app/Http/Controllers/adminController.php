<?php

namespace App\Http\Controllers;

use App\Models\Medic;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    public function Dashboard()
    {
        $jumlahPengguna = User::count();
        $jumlahAlkes = Medic::count();
        $jumlahPeminjaman = Borrow::count();
        return view('pages.admin.dashboard', compact('jumlahPengguna', 'jumlahAlkes', 'jumlahPeminjaman'));
    }
    public function listAdmin()
    {
        $listAdmin = User::where('admin', 'True')->get();
        return view('pages.admin.listAdmin', compact('listAdmin'));
    }
    public function tambahAdmin()
    {
        return view('pages.admin.tambahAdmin');
    }
    public function insertAdmin(Request $request){
        $request->validate([
            'password' => 'confirmed'
        ]);
        
        $RegisterUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin' => 'True',
        ]);
        if($RegisterUser){
            Session::flash('status', 'success');
            Session::flash('message', 'Admin berhasil ditambahkan');
            return redirect('/admin/list-admin');
        } 
        Session::flash('status', 'failed');
        Session::flash('message', 'Admin gagal ditambahkan');
        return redirect('/admin/list-admin');
    }
    public function deleteAdmin($id)
    {
        $deleteAdminn = User::find($id);
        $deleteAdminn->delete();
        if ($deleteAdminn) {
            Session::flash('status', 'success');
            Session::flash('message', 'Admin berhasil dihapus');
            return redirect('/admin/list-admin');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Admin gagal dihapus');
            return redirect('/admin/list-admin');
        }
    }
    public function editAdmin($id)
    {
        $editAdmin = User::find($id);
        return view('pages.admin.editAdmin', compact('editAdmin'));
    }
    public function updateAdmin(Request $request, $id)
    {
        $updateAdmin = User::find($id);
        $dataToUpdate = [
        'name' => $request->name,
        'email' => $request->email,
        ];

        // Cek apakah password diisi atau tidak
        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $updateAdmin->update($dataToUpdate);
        if ($updateAdmin) {
            Session::flash('status', 'success');
            Session::flash('message', 'Admin berhasil diperbarui');
            return redirect('/admin/list-admin');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Admin gagal diperbarui');
            return redirect('/admin/list-admin');
        }
    }
    public function listUser()
    {
        $listUser = User::where('admin', 'False')->get();
        return view('pages.admin.listUser', compact('listUser'));
    }
    public function deleteUser($id)
    {
       $deleteUser = User::find($id);
        if ($deleteUser->borrows()->where('is_return_approved', 0)->count() > 0)  {
            Session::flash('status', 'failed');
            Session::flash('message', 'Tidak bisa menghapus user yang masih memiliki peminjaman yang sedang berlangsung');
            return redirect('/admin/list-user');
        }
        $deleteUser->delete();
        if ($deleteUser) {
            Session::flash('status', 'success');
            Session::flash('message', 'User berhasil dihapus');
            return redirect('/admin/list-user');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Admin gagal dihapus');
            return redirect('/admin/list-user');
        }
    }
    public function editUser($id)
    {
        $editUser = User::find($id);
        return view('pages.admin.editUser', compact('editUser'));
    }
    public function updateUser(Request $request, $id)
    {
        $updateAdmin = User::find($id);
        $dataToUpdate = [
        'name' => $request->name,
        'email' => $request->email,
        ];

        // Cek apakah password diisi atau tidak
        if ($request->filled('password')) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $updateAdmin->update($dataToUpdate);
        if ($updateAdmin) {
            Session::flash('status', 'success');
            Session::flash('message', 'User berhasil diperbarui');
            return redirect('/admin/list-user');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Admin gagal diperbarui');
            return redirect('/admin/list-user');
        }
    }
    public function listMedics()
    {
        $listMedics = Medic::all();
        return view('pages.admin.listMedics', compact('listMedics'));
    }
    public function tambahAlatKesehatan()
    {
        return view('pages.admin.tambahAlatKesehatan');
    }
    public function insertAlatKesehatan(Request $request)
    {
        $ekstensi = $request->file('foto')->clientExtension();
        $nama = $request->name . '-' . now()->timestamp . '.' . $ekstensi;
        $request->file('foto')->storeAs('images', $nama);
        $request['foto'] = $nama;
        $insertProduct = Medic::create([
            'name' => $request->name,
            'foto' => $nama,
            'kategori' => $request->kategori,
            'merk' => $request->merk,
        ]);
        if ($insertProduct) {
            Session::flash('status', 'success');
            Session::flash('message', 'Alat kesehatan berhasil ditambahkan');
            return redirect('/admin/list-alat-kesehatan');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Alat kesehatan gagal ditambahkan');
            return redirect('/admin/list-alat-kesehatan');
        }
    }
    public function editAlatKesehatan($id)
    {
        $alatKesehatan = Medic::find($id);
        return view('pages.admin.editAlatKesehatan', compact('alatKesehatan'));
    }
    public function updateAlatKesehatan(Request $request, $id)
    {
        $editProduk = Medic::find($id);
        if ($request->hasFile('foto')) {
            // Jika ada file yang diunggah
            $ekstensi = $request->file('foto')->clientExtension();
            $nama = $request->name . '-' . now()->timestamp . '.' . $ekstensi;
            $request->file('foto')->storeAs('images', $nama);
            $editProduk->update([
                'name' => $request->name,
                'foto' => $nama,
                'kategori' => $request->kategori,
                'merk' => $request->merk,
            ]);
        } else {
            // Jika tidak ada file yang diunggah
            $editProduk->update([
                'name' => $request->name,
                'kategori' => $request->kategori,
                'merk' => $request->merk,
            ]);
        }
        if ($editProduk) {
            Session::flash('status', 'success');
            Session::flash('message', 'Alat kesehatan berhasil diperbarui');
            return redirect('/admin/list-alat-kesehatan');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Alat kesehatan gagal diperbarui');
            return redirect('/admin/list-alat-kesehatan');
        }
    }
    public function deleteAlatKesehatan($id)
    {
        $deleteProduct = Medic::find($id);
        $deleteProduct->delete();
        if ($deleteProduct) {
            Session::flash('status', 'success');
            Session::flash('message', 'Alat kesehatan berhasil dihapus');
            return redirect('/admin/list-alat-kesehatan');
        } else {
            Session::flash('status', 'failed');
            Session::flash('message', 'Alat kesehatan gagal dihapus');
            return redirect('/admin/list-alat-kesehatan');
        }
    }
    public function listPeminjaman()
    {
        $borrows = Borrow::with(['user', 'medic'])->get();
        return view('pages.admin.listBookings', compact('borrows'));
    }
    public function requestPengembalian()
    {
        $returnRequests = Borrow::with(['user', 'medic'])->where('is_return_requested', true)->get();
        return view('pages.admin.listBookings', compact('returnRequests'));
    }
    public function approveReturn($borrowId)
    {
        $borrow = Borrow::find($borrowId);
        if ($borrow) {
            $borrow->update(['is_return_approved' => true]);
            return redirect()->back()->with('success', 'Pengembalian disetujui.');
        }
        return redirect()->back()->with('error', 'Terjadi kesalahan.');
    }
}
