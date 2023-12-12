<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class authController extends Controller
{
    public function login(){
        return view('pages.login');
    }
    public function register(){
        return view('pages.register');
    }
    public function forgetPassword(){
        return view('pages.forgetPassword');
    }
    public function register_process(Request $request){
        $request->validate([
            'password' => 'confirmed'
        ]);
        
        $RegisterUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin' => 'False',
        ]);
        if($RegisterUser){
            Session::flash('status', 'success');
            Session::flash('message', 'registrasi kamu berhasil');
            return redirect('/login');
        } 
        Session::flash('status', 'failed');
        Session::flash('message', 'password validasi yang kamu masukan salah');
        return redirect('/register');
    }
    public function login_process(Request $request){
       $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->admin === 'True') {
            return redirect('/admin/dashboard');
        }

        return redirect('/');
    }
        Session::flash('status', 'failed');
        Session::flash('message', 'proses login gagal');
        return redirect('/login');
    }
    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}
