<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.desa.index', [
            'title' => 'Desa',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'dataDesa' => Desa::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.desa.create', [
            'title' => 'Desa',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_desa' => ['required', 'unique:desa'],
            'warna' => ['required', 'unique:desa'],
            'geojson' => ['required']
        ]);
        Desa::create($validatedData);
        return redirect('/admin/desa')->with('success', 'Desa berhasil ditambah!');
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
    public function edit(Desa $desa): Response
    {
        return response()->view('admin.desa.edit', [
            'title' => 'Desa',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'desa' => $desa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Desa $desa)
    {
        $rules = [
            'geojson' => ['required']
        ];
        if ($request->nama_desa != $desa->nama_desa) {
            $rules['nama_desa'] = ['required', 'unique:desa'];
        };
        if ($request->warna != $desa->warna) {
            $rules['warna'] = ['required', 'unique:desa'];
        };

        $validatedData = $request->validate($rules);
        Desa::where('id', $desa->id)
            ->update($validatedData);
        return redirect('/admin/desa')->with('success', 'Desa Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desa $desa)
    {
        Desa::destroy($desa->id);
        return redirect('/admin/desa')->with('success', 'Desa berhasil dihapus!');
    }
}
