<?php

namespace App\Http\Controllers;

use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LaporanKesehatanController extends Controller
{
    public function index(Request $request): Response
    {
        return response()->view('home.laporanKesehatan.index', [
            'title' => 'SIG | Laporan Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }
}
