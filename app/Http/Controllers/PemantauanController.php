<?php

namespace App\Http\Controllers;

use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PemantauanController extends Controller
{
    public function index(Request $request): Response
    {
        return response()->view('home.pemantauan.index', [
            'title' => 'SIG | Pemantauan Penyakit',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }
}
