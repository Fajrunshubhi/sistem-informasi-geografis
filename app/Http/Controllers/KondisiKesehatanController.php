<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\KondisiKesehatan;
use App\Models\Penyakit;
use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Log\Logger;

class KondisiKesehatanController extends Controller
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

        $kondisi_kesehatan = KondisiKesehatan::whereHas('pasien', function ($query) use ($select_desa_id) {
            $query->whereIn('desa_id', $select_desa_id);
        })->get();


        return response()->view('home.kondisiKesehatan.index', [
            'title' => 'SIG | Sebaran Kondisi Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'desa_all' => $desa_all,
            'desa' => $desa,
            'penyakit' => Penyakit::all(),
            'kondisi_kesehatan' => $kondisi_kesehatan,
        ]);
    }
}
