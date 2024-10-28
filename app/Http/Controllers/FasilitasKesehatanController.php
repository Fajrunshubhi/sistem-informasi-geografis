<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\FasilitasKesehatan;
use App\Models\KategoriFasilitas;
use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FasilitasKesehatanController extends Controller
{
    public function index(Request $request): Response
    {
        $select_desa = $request->input('nama_desa');
        $desa_all = Desa::all();
        if ($select_desa && !$desa_all->pluck('nama_desa')->contains($select_desa)) {
            return redirect()->back();
        }
        $desa = Desa::when($select_desa, function ($query, $search) {
            return $query->where('nama_desa', 'like', "%{$search}%");
        })->get();
        // Ambil desa_id dari desa yang ditemukan
        $select_desa_id = $desa->pluck('id');

        $fasilitas_kesehatan = FasilitasKesehatan::when($select_desa_id, function ($query, $search) use ($select_desa_id) {
            return $query->whereIn('desa_id', $select_desa_id);
        })->get();

        return response()->view('home.fasilitasKesehatan.index', [
            'title' => 'SIG | Sebaran Fasilitas Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'desa_all' => $desa_all,
            'desa' => $desa,
            'kategori_fasilitas' => KategoriFasilitas::all(),
            'fasilitas_kesehatan' => $fasilitas_kesehatan
        ]);
    }
}
