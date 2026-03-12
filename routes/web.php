<?php

use App\Http\Controllers\KategoribukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//admin & petugas
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::get('/admin/dashboard', [BukuController::class, 'adminDashboard'])->name('admin.dashboard');

    //buku
    Route::resource('buku', BukuController::class);

    //laporan
    Route::get('/laporan', [PeminjamanController::class, 'laporan'])->name('laporan.index');

    //kategori buku
    Route::resource('kategori', KategoribukuController::class);

    //acc admin
    Route::post('/admin/acc-kembali/{id}', [PeminjamanController::class, 'acc'])->name('admin.acc_kembali');
    Route::post('/admin/tolak-kembali/{id}', [PeminjamanController::class, 'tolakKembali'])->name('admin.tolak_kembali');
});

//admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/user/create', [UserController::class, 'createPetugas'])->name('admin.user.create');
    Route::post('/admin/user/store', [UserController::class, 'storePetugas'])->name('admin.user.store');
});

//role peminjam
Route::middleware(['auth', 'role:peminjam'])->group(function () {
    Route::get('/peminjam/dashboard', function () {
        return view('peminjam.dashboard');
    })->name('peminjam.dashboard');
    Route::get('/peminjam/dashboard', [PeminjamanController::class, 'index'])->name('peminjam.dashboard');
    Route::get('/peminjam/kategori/{id}', [PeminjamanController::class, 'kategori'])->name('peminjam.kategori');

    //peminjaman 
    Route::get('/pinjam-buku', [PeminjamanController::class, 'index'])->name('pinjam.index');
    Route::get('/peminjam/dashboard', [PeminjamanController::class, 'index'])->name('peminjam.dashboard');
    Route::get('/pinjam/buku/{id}', [PeminjamanController::class, 'create'])->name('pinjam.form');
    Route::post('/pinjam/simpan', [PeminjamanController::class, 'store'])->name('pinjam.store');

    //koleksi
    Route::get('/peminjam/koleksi', [PeminjamanController::class, 'koleksiPribadi'])->name('peminjam.koleksi');

    //pengembalian
    Route::post('/peminjam/kembali/{id}', [PeminjamanController::class, 'kembalikan'])->name('peminjam.kembali');
});
