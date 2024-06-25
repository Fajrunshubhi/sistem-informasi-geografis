<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminPenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.penyakit.index', [
            'title' => 'Penyakit',
            'penyakit' => Penyakit::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.penyakit.create', [
            'title' => 'Penyakit'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_penyakit' => ['required'],
            'deskripsi' => ['required'],
            'kategori' => ['required', 'in:Menular,Tidak Menular'],
            'gejala' => ['required'],
            'metode_pengobatan' => ['required'],
            'tindakan_pencegahan' => ['required'],
        ]);

        Penyakit::create($validatedData);
        return redirect('/admin/penyakit')->with('success', 'Data Penyakit Berhasil Ditambah!');
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
    public function edit(Penyakit $penyakit)
    {
        return response()->view('admin.penyakit.edit', [
            'title' => 'Penyakit',
            'penyakit' => $penyakit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyakit $penyakit)
    {
        $validatedData = $request->validate([
            'nama_penyakit' => ['required'],
            'deskripsi' => ['required'],
            'kategori' => ['required', 'in:Menular,Tidak Menular'],
            'gejala' => ['required'],
            'metode_pengobatan' => ['required'],
            'tindakan_pencegahan' => ['required'],
        ]);

        Penyakit::where('id', $penyakit->id)
            ->update($validatedData);
        return redirect('/admin/penyakit')->with('success', 'Data Penyakit Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyakit $penyakit)
    {
        Penyakit::destroy($penyakit->id);
        return redirect('/admin/penyakit')->with('success', 'Data Penyakit Berhasil Dihapus!');
    }
}
