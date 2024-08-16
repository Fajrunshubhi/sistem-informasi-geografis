<?php

namespace App\Http\Controllers;

use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PusatKesehatanController extends Controller
{
    public function index(Request $request): Response
    {
        return response()->view('home.pusatKesehatan.index', [
            'title' => 'SIG | Sebaran Pusat Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }
}
