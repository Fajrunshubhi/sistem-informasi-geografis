<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKesehatan;
use App\Models\LayananKesehatan;
use App\Models\ProfilKecamatan;
use App\Models\PusatKesehatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KontakController extends Controller
{
    public function index(Request $request): Response
    {
        $search_pusat_kesehatan = $request->input('search-pusat-kesehatan');
        $kontak_pusat_kesehatan = PusatKesehatan::when($search_pusat_kesehatan, function ($query, $search) {
            return $query->where('nama_pusat_kesehatan', 'like', "%{$search}%");
        })->get();

        $search_fasilitas_kesehatan = $request->input('search-fasilitas-kesehatan');
        $kontak_fasilitas_kesehatan = FasilitasKesehatan::when($search_fasilitas_kesehatan, function ($query, $search) {
            return $query->where('nama_fasilitas', 'like', "%{$search}%");
        })->get();

        $search_layanan_kesehatan = $request->input('search-layanan-kesehatan');
        $kontak_layanan_kesehatan = LayananKesehatan::when($search_layanan_kesehatan, function ($query, $search) {
            return $query->where('nama_layanan', 'like', "%{$search}%");
        })->get();

        return response()->view('home.kontak.index', [
            'title' => 'SIG | Kontak',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'kontak_pusat_kesehatan' => $kontak_pusat_kesehatan,
            'kontak_fasilitas_kesehatan' => $kontak_fasilitas_kesehatan,
            'kontak_layanan_kesehatan' => $kontak_layanan_kesehatan
        ]);
    }
}
