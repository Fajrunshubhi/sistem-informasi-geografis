<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\ProfilKecamatan;
use App\Models\PusatKesehatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PusatKesehatanController extends Controller
{
    public function index(Request $request)
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

        // Gunakan desa_id untuk mencari pusat kesehatan yang terkait
        $pusat_kesehatan = PusatKesehatan::when($select_desa_id, function ($query, $search) use ($select_desa_id) {
            return $query->whereIn('desa_id', $select_desa_id);
        })->get();

        return response()->view('home.pusatKesehatan.index', [
            'title' => 'SIG | Sebaran Pusat Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'desa_all' => $desa_all,
            'desa' => $desa,
            'pusat_kesehatan' => $pusat_kesehatan
        ]);
    }
}
