<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MuridController;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/kelas', [AdminController::class, 'kelas'])->name('admin.kelas');
    Route::post('/assign-murid', [AdminController::class, 'assignMurid']);
    Route::post('/assign-guru', [AdminController::class, 'assignGuru']);
    Route::post('/kelas/tambah', [AdminController::class, 'tambahKelas'])->name('admin.tambahKelas');
    Route::delete('/kelas/hapus/{id}', [AdminController::class, 'hapusKelas'])->name('admin.hapusKelas');
    Route::get('/pencapaian', [AdminController::class, 'lihatPencapaian']);
    Route::delete('/pencapaian/hapus', [AdminController::class, 'hapusPencapaian']);
    Route::post('/kelas/{id}/target', [AdminController::class, 'aturTarget']);
    Route::get('/admin/akun', [AdminController::class, 'lihatSemuaAkun'])->name('admin.lihatAkun');
    Route::put('/user/ubah/{id}', [AdminController::class, 'ubahUser'])->name('admin.ubahUser');
    Route::delete('/user/hapus/{id}', [AdminController::class, 'hapusUser'])->name('admin.hapusUser');
    Route::post('/admin/kelas/{kelasId}/tambah-guru', [AdminController::class, 'tambahGuruKeKelas'])->name('admin.tambahGuruKeKelas');
    Route::post('/admin/kelas/{kelasId}/tambah-murid', [AdminController::class, 'tambahMuridKeKelas'])->name('admin.tambahMuridKeKelas');

});


Route::middleware(['role:guru'])->prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/murid/{id}', [GuruController::class, 'lihatDetailMurid'])->name('guru.lihatDetailMurid');
    Route::post('/pencapaian/tambah', [GuruController::class, 'tambahPencapaian'])->name('guru.tambahPencapaian');
    Route::delete('/pencapaian/{id}/hapus', [GuruController::class, 'hapusPencapaian'])->name('guru.hapusPencapaian');
    Route::post('/tambah-halaman', [GuruController::class, 'tambahHalamanGuru'])->name('guru.tambahHalamanGuru');
    Route::delete('/hapus-pencapaian-guru', [GuruController::class, 'hapusPencapaianGuru'])->name('guru.hapusPencapaianGuru');
});



Route::middleware(['role:murid'])->prefix('murid')->group(function () {
    Route::get('/dashboard', [MuridController::class, 'dashboard'])->name('murid.dashboard');
    Route::post('/pencapaian/tambah', [MuridController::class, 'simpanPencapaian']);
    Route::put('/pencapaian/update/{id}', [MuridController::class, 'updatePencapaian']);
    Route::delete('/pencapaian/hapus/{id}', [MuridController::class, 'hapusPencapaian']);
});
