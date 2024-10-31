<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\LayananKesehatan;
use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LayananKesehatanController extends Controller
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

        $layanan_kesehatan = LayananKesehatan::when($select_desa_id, function ($query, $search) use ($select_desa_id) {
            return $query->whereIn('desa_id', $select_desa_id);
        })->get();


        return response()->view('home.layananKesehatan.index', [
            'title' => 'SIG | Sebaran Layanan Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'desa_all' => $desa_all,
            'desa' => $desa,
            'layanan_kesehatan' => $layanan_kesehatan
        ]);
    }
}
