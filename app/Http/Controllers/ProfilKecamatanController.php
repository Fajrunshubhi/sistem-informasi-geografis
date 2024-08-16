<?php

namespace App\Http\Controllers;

use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfilKecamatanController extends Controller
{
    public function index(Request $request): Response
    {
        return response()->view('home.profilKecamatan.index', [
            'title' => 'SIG | Profil Kecamatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }
}
