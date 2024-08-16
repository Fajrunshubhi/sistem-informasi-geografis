<?php

namespace App\Http\Controllers;

use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BeritaInformasiController extends Controller
{
    public function index(Request $request): Response
    {
        return response()->view('home.beritaInformasi.index', [
            'title' => 'SIG | Berita dan Informasi',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }
}
