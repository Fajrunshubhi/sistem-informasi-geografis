<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKesehatan;
use App\Models\LayananKesehatan;
use App\Models\ProfilKecamatan;
use App\Models\PusatKesehatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KontakController extends Controller
{
    public function index(Request $request): Response
    {
        return response()->view('home.kontak.index', [
            'title' => 'SIG | Kontak',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'kontak_pusat_kesehatan' => PusatKesehatan::orderBy('desa_id', 'desc')->get(),
            'kontak_fasilitas_kesehatan' => FasilitasKesehatan::orderBy('desa_id', 'desc')->get(),
            'kontak_layanan_kesehatan' => LayananKesehatan::orderBy('desa_id', 'desc')->get()
        ]);
    }
}
