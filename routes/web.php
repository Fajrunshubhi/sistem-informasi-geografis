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
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\BeritaInformasiController;
use App\Http\Controllers\FasilitasKesehatanController;
use App\Http\Controllers\KondisiKesehatanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LaporanKesehatanController;
use App\Http\Controllers\LayananKesehatanController;
use App\Http\Controllers\PemantauanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilKecamatanController;
use App\Http\Controllers\PusatKesehatanController;
use Illuminate\Support\Facades\Route;

// HOME
Route::get('/', [BerandaController::class, 'index']);
Route::redirect('sebaran', '/sebaran/pusat-kesehatan');
Route::get('/sebaran/pusat-kesehatan', [PusatKesehatanController::class, 'index']);
Route::get('/sebaran/fasilitas-kesehatan', [FasilitasKesehatanController::class, 'index']);
Route::get('/sebaran/layanan-kesehatan', [LayananKesehatanController::class, 'index']);
Route::get('/sebaran/kondisi-kesehatan', [KondisiKesehatanController::class, 'index']);
Route::get('/pemantauan-penyakit', [PemantauanController::class, 'index']);
Route::get('/laporan-kesehatan', [LaporanKesehatanController::class, 'index']);
Route::get('/berita-informasi', [BeritaInformasiController::class, 'index']);
Route::get('/berita-informasi/{berita_informasi:slug}', [BeritaInformasiController::class, 'show']);
Route::get('/profil-kecamatan', [ProfilKecamatanController::class, 'index']);
Route::get('/kontak', [KontakController::class, 'index']);



Route::redirect('admin', '/admin/dashboard');
Route::redirect('dashboard', '/admin/dashboard');
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/admin/user/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/admin/user', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/admin/user', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/admin/data/pusat-kesehatan', AdminPusatKesehatanController::class)->middleware(['auth', 'check_desa', 'desa_validation']);
Route::resource('/admin/data/fasilitas-kesehatan', AdminFasilitasKesehatanController::class)->middleware(['auth', 'check_desa', 'desa_validation']);
Route::resource('/admin/data/layanan-kesehatan', AdminLayananKesehatanController::class)->middleware(['auth', 'check_desa', 'desa_validation']);
Route::resource('/admin/data/kondisi-kesehatan', AdminKondisiKesehatanController::class)->middleware(['auth', 'check_desa', 'desa_validation']);
Route::resource('/admin/data/kategori-fasilitas', AdminKategoriFasilitasController::class)->middleware(['auth']);

Route::resource('/admin/pasien', AdminPasienController::class)->middleware(['auth', 'check_desa', 'desa_validation']);
Route::resource('/admin/penyakit', AdminPenyakitController::class)->middleware(['auth']);
Route::resource('/admin/pemantauan', AdminPemantauanController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/laporan-kesehatan', AdminLaporanKesehatanController::class)->middleware(['auth', 'check_desa', 'desa_validation']);
Route::resource('/admin/desa', AdminDesaController::class)->middleware(['auth', 'check_desa', 'is_SuperAdmin']);
Route::resource('/admin/berita-informasi', AdminBeritaInformasiController::class)->middleware(['auth', 'check_desa']);
Route::resource('/admin/profil-kecamatan', AdminProfilKecamatanController::class)->middleware(['auth', 'is_SuperAdmin']);

Route::get('/admin/user', [AdminUserController::class, 'index'])->middleware(['auth', 'is_SuperAdmin']);
Route::delete('/admin/user/{user}', [AdminUserController::class, 'destroy'])->middleware(['auth'])->name('user.destroy.bysuperadmin');


// EXPORT
Route::get('users-export', [AdminUserController::class, 'export'])->name('users.export');

Route::get('pusat-kesehatan-export', [AdminPusatKesehatanController::class, 'export'])->name('pusat.kesehatan.export');

Route::get('fasilitas-kesehatan-export', [AdminFasilitasKesehatanController::class, 'export'])->name('fasilitas.kesehatan.export');

Route::get('layanan-kesehatan-export', [AdminLayananKesehatanController::class, 'export'])->name('layanan.kesehatan.export');

Route::get('kondisi-kesehatan-export', [AdminKondisiKesehatanController::class, 'export'])->name('kondisi.kesehatan.export');

Route::get('kategori-fasilitas-export', [AdminKategoriFasilitasController::class, 'export'])->name('kategori.fasilitas.export');

Route::get('pasien-export', [AdminPasienController::class, 'export'])->name('pasien.export');

Route::get('penyakit-export', [AdminPenyakitController::class, 'export'])->name('penyakit.export');

Route::get('pemantauan-export', [AdminPemantauanController::class, 'export'])->name('pemantauan.export');

Route::get('laporan-kesehatan-export', [AdminLaporanKesehatanController::class, 'export'])->name('laporan.kesehatan.export');

Route::get('desa-export', [AdminDesaController::class, 'export'])->name('desa.export');

Route::get('berita-informasi-export', [AdminBeritaInformasiController::class, 'export'])->name('berita.informasi.export');

Route::get('profil-kecamatan-export', [AdminProfilKecamatanController::class, 'export'])->name('profil.kecamatan.export');

require __DIR__ . '/auth.php';
