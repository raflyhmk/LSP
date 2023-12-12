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
    $alatKesehatan = Medic::take(4)->get();
    return view('welcome', compact('alatKesehatan'));
});
Route::get('/profile', [userController::class, 'profile'])->middleware(['auth', 'isUser']);
Route::put('/profile', [userController::class, 'editProfile'])->middleware(['auth', 'isUser']);
Route::get('/medical-supplies', [userController::class, 'medicalSupplies']);
Route::get('/history-supplies', [userController::class, 'historySupplies'])->middleware(['auth', 'isUser']);
Route::post('/borrow-item', [userController::class, 'borrowItem'])->name('borrow.item')->middleware(['auth', 'isUser']);
Route::post('/request-return/{id}', [userController::class, 'requestReturn'])->name('request.return')->middleware(['auth', 'isUser']);


// auth proses (login, register, forget password)
Route::get('/login', [authController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [authController::class, 'login_process']);
Route::get('/register', [authController::class, 'register']);
Route::post('/register', [authController::class, 'register_process']);
Route::get('/forget-password', [authController::class, 'forgetPassword']);
Route::get('/logout', [authController::class, 'logout'])->middleware('auth');

// admin side
Route::get('/admin/dashboard', [adminController::class, 'Dashboard'])->middleware(['auth', 'isAdmin']);
Route::get('/admin/list-admin', [adminController::class, 'listAdmin'])->middleware(['auth', 'isAdmin']);
Route::get('/admin/tambah-admin', [adminController::class, 'tambahAdmin'])->middleware(['auth', 'isAdmin']);
Route::post('/admin/tambah-admin', [adminController::class, 'insertAdmin'])->middleware(['auth', 'isAdmin']);
Route::get('/admin/edit-admin/{id}', [adminController::class, 'editAdmin'])->middleware(['auth', 'isAdmin']);
Route::put('/admin/edit-admin/{id}', [adminController::class, 'updateAdmin'])->middleware(['auth', 'isAdmin']);
Route::delete('/admin/hapus-admin/{id}', [adminController::class, 'deleteAdmin'])->middleware(['auth', 'isAdmin']);
Route::get('/admin/list-user', [adminController::class, 'listUser'])->middleware(['auth', 'isAdmin']);
Route::get('/admin/edit-user/{id}', [adminController::class, 'editUser'])->middleware(['auth', 'isAdmin']);
Route::put('/admin/edit-user/{id}', [adminController::class, 'updateUser'])->middleware(['auth', 'isAdmin']);
Route::delete('/admin/hapus-user/{id}', [adminController::class, 'deleteUser'])->middleware(['auth', 'isAdmin']);
Route::get('/admin/list-alat-kesehatan', [adminController::class, 'listMedics'])->middleware(['auth', 'isAdmin']);
Route::get('/admin/tambah-alat-kesehatan', [adminController::class, 'tambahAlatKesehatan'])->middleware(['auth', 'isAdmin']);
Route::post('/admin/tambah-alat-kesehatan', [adminController::class, 'insertAlatKesehatan'])->middleware(['auth', 'isAdmin']);
Route::get('/admin/edit-alat-kesehatan/{id}', [adminController::class, 'editAlatKesehatan'])->middleware(['auth', 'isAdmin']);
Route::put('/admin/edit-alat-kesehatan/{id}', [adminController::class, 'updateAlatKesehatan'])->middleware(['auth', 'isAdmin']);
Route::delete('/admin/hapus-alat-kesehatan/{id}', [adminController::class, 'deleteAlatKesehatan'])->middleware(['auth', 'isAdmin']);
Route::get('/admin/list-peminjaman', [adminController::class, 'listPeminjaman'])->middleware(['auth', 'isAdmin']);
Route::post('/admin/approve-return/{id}', [adminController::class, 'approveReturn'])->name('approve.return')->middleware(['auth', 'isAdmin']);


