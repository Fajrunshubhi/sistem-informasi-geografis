<?php

namespace App\Http\Controllers;

use App\Models\KondisiKesehatan;
use App\Models\Pasien;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminKondisiKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.kondisiKesehatan.index', [
            'title' => 'Kondisi Kesehatan',
            'kondisi_kesehatan' => KondisiKesehatan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.kondisiKesehatan.create', [
            'title' => 'Kondisi Kesehatan',
            'pasien' => Pasien::all(),
            'penyakit' => Penyakit::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pasien_id' => ['required', 'exists:pasien,id'],
            'penyakit_id' => ['required', 'exists:penyakit,id'],
            'waktu_terdeteksi' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required']
        ]);

        KondisiKesehatan::create($validatedData);
        return redirect('/admin/data/kondisi-kesehatan')->with('success', 'Data Kondisi Kesehatan Berhasil Ditambah!');
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
    public function edit(KondisiKesehatan $kondisi_kesehatan)
    {
        return response()->view('admin.kondisiKesehatan.edit', [
            'title' => 'Kondisi Kesehatan',
            'kondisi_kesehatan' => $kondisi_kesehatan,
            'pasien' => Pasien::all(),
            'penyakit' => Penyakit::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KondisiKesehatan $kondisi_kesehatan)
    {
        $validatedData = $request->validate([
            'pasien_id' => ['required', 'exists:pasien,id'],
            'penyakit_id' => ['required', 'exists:penyakit,id'],
            'waktu_terdeteksi' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required']
        ]);

        KondisiKesehatan::where('id', $kondisi_kesehatan->id)
            ->update($validatedData);

        return redirect('/admin/data/kondisi-kesehatan')->with('success', 'Data Kondisi Kesehatan Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KondisiKesehatan $kondisi_kesehatan)
    {
        KondisiKesehatan::destroy($kondisi_kesehatan->id);
        return redirect('/admin/data/kondisi-kesehatan')->with('success', 'Data Kondisi Kesehatan Berhasil Dihapus!');
    }
}
