<?php

namespace App\Http\Controllers;

use App\Models\BeritaInformasi;
use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BeritaInformasiController extends Controller
{
    public function index(Request $request): Response
    {
        $search_berita_informasi = $request->input('search-berita-informasi');
        $berita_informasi = BeritaInformasi::when($search_berita_informasi, function ($query, $search) {
            return $query->where('judul', 'like', "%{$search}%");
        })->latest()->paginate(7);

        return response()->view('home.beritaInformasi.index', [
            'title' => 'SIG | Berita dan Informasi',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            "berita_informasi" => $berita_informasi
        ]);
    }

    public function show(BeritaInformasi $beritaInformasi)
    {
        return response()->view('home.beritaInformasi.detail', [
            'title' => 'SIG | Berita dan Informasi',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            "berita_informasi" => $beritaInformasi
        ]);
    }
}
