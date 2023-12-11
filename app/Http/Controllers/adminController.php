<?php

namespace App\Http\Controllers;

use App\Models\Medic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class adminController extends Controller
{
    public function Dashboard(){
        return view('pages.admin.dashboard');
    }
    public function listAdmin(){
        $listAdmin = User::where('admin', 'True')->get();
        return view('pages.admin.listAdmin', compact('listAdmin'));
    }
    public function listUser(){
        $listUser = User::where('admin', 'False')->get();
        return view('pages.admin.listUser', compact('listUser'));
    }
    public function listMedics(){
        $listMedics = Medic::all();
        return view('pages.admin.listMedics', compact('listMedics'));
    }
    public function tambahAlatKesehatan(){
        return view('pages.admin.tambahAlatKesehatan');
    }
    public function insertAlatKesehatan(Request $request){
        $ekstensi = $request->file('foto')->clientExtension();
        $nama = $request->name.'-'.now()->timestamp.'.'.$ekstensi;
        $request->file('foto')->storeAs('images', $nama);
        $request['foto'] = $nama;
        $insertProduct = Medic::create([
            'name' => $request->name,
            'foto' => $nama,
            'kategori' => $request->kategori,
            'merk' => $request->merk,
        ]);
        if($insertProduct){
            Session::flash('status', 'success');
            Session::flash('message', 'Alat kesehatan berhasil ditambahkan');
            return redirect('/admin/list-alat-kesehatan');
        } else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Alat kesehatan gagal ditambahkan');
            return redirect('/admin/list-alat-kesehatan');
        }
    }
    public function editAlatKesehatan($id){
        $alatKesehatan = Medic::find($id);
        return view('pages.admin.editAlatKesehatan', compact('alatKesehatan'));
    }
    public function updateAlatKesehatan(Request $request, $id){
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
        if($editProduk){
            Session::flash('status', 'success');
            Session::flash('message', 'Alat kesehatan berhasil diperbarui');
            return redirect('/admin/list-alat-kesehatan');
        } else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Alat kesehatan gagal diperbarui');
            return redirect('/admin/list-alat-kesehatan');
        }
    }
    public function deleteAlatKesehatan($id){
        $deleteProduct = Medic::find($id);
        $deleteProduct->delete();
        if($deleteProduct){
            Session::flash('status', 'success');
            Session::flash('message', 'Alat kesehatan berhasil dihapus');
            return redirect('/admin/list-alat-kesehatan');
        } else{
            Session::flash('status', 'failed');
            Session::flash('message', 'Alat kesehatan gagal dihapus');
            return redirect('/admin/list-alat-kesehatan');
        }
    }
    public function listPeminjaman(){
        return view('pages.admin.listBookings');
    }
}
