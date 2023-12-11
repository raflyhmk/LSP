<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\authController;
use App\Http\Controllers\userController;
use App\Models\Medic;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// user side
Route::get('/', function () {
    $alatKesehatan = Medic::all();
    return view('welcome', compact('alatKesehatan'));
});
Route::get('/profile', [userController::class, 'profile']);
Route::put('/profile', [userController::class, 'editProfile']);
Route::get('/medical-supplies', [userController::class, 'medicalSupplies']);


// auth proses (login, register, forget password)
Route::get('/login', [authController::class, 'login']);
Route::post('/login', [authController::class, 'login_process']);
Route::get('/register', [authController::class, 'register']);
Route::post('/register', [authController::class, 'register_process']);
Route::get('/forget-password', [authController::class, 'forgetPassword']);
Route::get('/logout', [authController::class, 'logout']);

// admin side
Route::get('/admin/dashboard', [adminController::class, 'Dashboard']);
Route::get('/admin/list-admin', [adminController::class, 'listAdmin']);
Route::get('/admin/list-user', [adminController::class, 'listUser']);
Route::get('/admin/list-alat-kesehatan', [adminController::class, 'listMedics']);
Route::get('/admin/tambah-alat-kesehatan', [adminController::class, 'tambahAlatKesehatan']);
Route::post('/admin/tambah-alat-kesehatan', [adminController::class, 'insertAlatKesehatan']);
Route::get('/admin/edit-alat-kesehatan/{id}', [adminController::class, 'editAlatKesehatan']);
Route::put('/admin/edit-alat-kesehatan/{id}', [adminController::class, 'updateAlatKesehatan']);
Route::delete('/admin/hapus-alat-kesehatan/{id}', [adminController::class, 'deleteAlatKesehatan']);
Route::get('/admin/list-peminjaman', [adminController::class, 'listPeminjaman']);

