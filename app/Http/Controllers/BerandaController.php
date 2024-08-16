<?php

namespace App\Http\Controllers;

use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BerandaController extends Controller
{
    public function index(Request $request): Response
    {
        return response()->view('home.beranda.index', [
            'title' => 'SIG | Beranda',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }
}
