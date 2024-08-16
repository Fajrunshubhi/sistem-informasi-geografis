<?php

namespace App\Http\Controllers;

use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FasilitasKesehatanController extends Controller
{
    public function index(Request $request): Response
    {
        return response()->view('home.fasilitasKesehatan.index', [
            'title' => 'SIG | Sebaran Fasilitas Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }
}
