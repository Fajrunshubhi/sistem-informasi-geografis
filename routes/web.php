<?php

use App\Http\Controllers\AdminBeritaInformasiController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDesaController;
use App\Http\Controllers\AdminFasilitasKesehatanController;
use App\Http\Controllers\AdminKategoriFasilitasController;
use App\Http\Controllers\AdminKondisiKesehatanController;
use App\Http\Controllers\AdminLaporanKesehatanController;
use App\Http\Controllers\AdminLayananKesehatanController;
use App\Http\Controllers\AdminPasienController;
use App\Http\Controllers\AdminPemantauanController;
use App\Http\Controllers\AdminPenyakitController;
use App\Http\Controllers\AdminProfilKecamatanController;
use App\Http\Controllers\AdminPusatKesehatanController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::redirect('admin', '/admin/dashboard');
Route::redirect('dashboard', '/admin/dashboard');
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin/user/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/user', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/user', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/admin/data/pusat-kesehatan', AdminPusatKesehatanController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/data/fasilitas-kesehatan', AdminFasilitasKesehatanController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/data/layanan-kesehatan', AdminLayananKesehatanController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/data/kondisi-kesehatan', AdminKondisiKesehatanController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/data/kategori-fasilitas', AdminKategoriFasilitasController::class)->middleware(['auth']);

Route::resource('/admin/pasien', AdminPasienController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/penyakit', AdminPenyakitController::class)->middleware(['auth']);
Route::resource('/admin/pemantauan', AdminPemantauanController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/laporan-kesehatan', AdminLaporanKesehatanController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/desa', AdminDesaController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/berita-informasi', AdminBeritaInformasiController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/profil-kecamatan', AdminProfilKecamatanController::class)->middleware(['auth']);

Route::get('/admin/user', [AdminUserController::class, 'index'])->middleware(['auth', 'is_SuperAdmin']);
Route::delete('/admin/user/{user}', [AdminUserController::class, 'destroy'])->middleware(['auth'])->name('user.destroy.bysuperadmin');


require __DIR__ . '/auth.php';
