<?php

namespace App\Http\Controllers;

use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminProfilKecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.profilKecamatan.index', [
            'title' => 'Profil Kecamatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(ProfilKecamatan $profil_kecamatan)
    {
        return response()->view('admin.profilKecamatan.edit', [
            'title' => 'Profil Kecamatan',
            'profil_kecamatan' => $profil_kecamatan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfilKecamatan $profil_kecamatan)
    {
        $validatedData = $request->validate([
            'nama' => ['required'],
            'no_tlpn' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'alamat' => ['required'],
            'deskripsi' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);

        ProfilKecamatan::where('id', $profil_kecamatan->id)
            ->update($validatedData);
        return redirect('/admin/profil-kecamatan')->with('success', 'Data Profil Kecamatan Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
