<?php

namespace App\Http\Controllers;

use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KontakController extends Controller
{
    public function index(Request $request): Response
    {
        return response()->view('home.kontak.index', [
            'title' => 'SIG | Kontak',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }
}
