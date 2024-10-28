<?php

namespace App\Http\Controllers;

use App\Exports\KategoriFasilitasExport;
use App\Models\KategoriFasilitas;
use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class AdminKategoriFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.kategoriFasilitas.index', [
            'title' => "Kategori Fasilitas",
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'kategoriFasilitas' => KategoriFasilitas::latest()->get()
        ]);
    }

    public function export()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = now()->format('Y-m-d_His');
        $fileName = 'Kategori_Fasilitas_' . $currentDateTime . '.xlsx';
        return Excel::download(new KategoriFasilitasExport, $fileName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.kategoriFasilitas.create', [
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'title' => 'Kategori Fasilitas',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required'],
            'warna' => ['required']
        ]);
        KategoriFasilitas::create($validatedData);
        return redirect('/admin/data/kategori-fasilitas')->with('success', 'Data Kategori Fasilitas Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriFasilitas $kategori_fasilita): Response
    {
        return response()->view('admin.kategoriFasilitas.edit', [
            'title' => 'Edit Kategori Fasilitas',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'kategoriFasilitas' => $kategori_fasilita
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriFasilitas $kategori_fasilita)
    {
        $rules = [
            'nama' => ['required']
        ];
        if ($request->warna != $kategori_fasilita->warna) {
            $rules['warna'] = ['required'];
        };

        $validatedData = $request->validate($rules);
        KategoriFasilitas::where('id', $kategori_fasilita->id)
            ->update($validatedData);
        return redirect('/admin/data/kategori-fasilitas')->with('success', 'Data Kategori Fasilitas Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriFasilitas $kategori_fasilita)
    {
        KategoriFasilitas::destroy($kategori_fasilita->id);
        return redirect('/admin/data/kategori-fasilitas')->with('success', 'Data Kategori Fasilitas Berhasil Dihapus!');
    }
}
