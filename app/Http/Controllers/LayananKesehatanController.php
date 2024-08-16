<?php

namespace App\Http\Controllers;

use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LayananKesehatanController extends Controller
{
    public function index(Request $request): Response
    {
        return response()->view('home.layananKesehatan.index', [
            'title' => 'SIG | Sebaran Layanan Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }
}
