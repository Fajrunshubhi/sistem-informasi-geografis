<?php

namespace App\Http\Controllers;

use App\Models\BeritaInformasi;
use App\Models\Desa;
use App\Models\FasilitasKesehatan;
use App\Models\KondisiKesehatan;
use App\Models\LaporanKesehatan;
use App\Models\LayananKesehatan;
use App\Models\Pasien;
use App\Models\Pemantauan;
use App\Models\Penyakit;
use App\Models\ProfilKecamatan;
use App\Models\PusatKesehatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $totalPusatKesehatan = PusatKesehatan::count();
        return response()->view('admin.dashboard.index', [
            'title' => 'Dashboard',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'totalPusatKesehatan' => PusatKesehatan::where('desa_id', Auth()->user()->desa_id)->count(),
            'totalFasilitasKesehatan' => FasilitasKesehatan::where('desa_id', Auth()->user()->desa_id)->count(),
            'totalLayananKesehatan' => LayananKesehatan::where('desa_id', Auth()->user()->desa_id)->count(),
            'totalKondisiKesehatan' => KondisiKesehatan::whereHas('pasien', function ($query) {
                $query->where('desa_id', Auth()->user()->desa_id);
            })->count(),
            'totalPasien' => Pasien::where('desa_id', Auth()->user()->desa_id)->count(),
            'totalPenyakit' => Penyakit::count(),
            'totalPemantauan' => Pemantauan::whereHas('kondisi_kesehatan', function ($query) {
                $query->whereHas('pasien', function ($query) {
                    $query->where('desa_id', Auth()->user()->desa_id);
                });
            })->count(),
            'totalLaporanKesehatan' => LaporanKesehatan::where('desa_id', Auth()->user()->desa_id)->count(),
            'totalBerita' => BeritaInformasi::whereHas('user', function ($query) {
                $query->where('desa_id', Auth()->user()->desa_id);
            })->count(),
            'totalUser' => User::where('desa_id', Auth()->user()->desa_id)->count(),
        ]);
    }
}
