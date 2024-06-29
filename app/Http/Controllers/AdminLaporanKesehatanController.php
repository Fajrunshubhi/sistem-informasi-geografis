<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\LaporanKesehatan;
use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AdminLaporanKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.laporanKesehatan.index', [
            'title' => 'Laporan Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'laporan_kesehatan' => LaporanKesehatan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.laporanKesehatan.create', [
            'title' => 'Laporan Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'desa' => Desa::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desa_id' => ['required', 'exists:desa,id'],
            'judul_laporan' => ['required'],
            'deskripsi' => ['required'],
            'file' => ['nullable', 'file', 'max:20480']
        ]);
        if ($request->file('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('file-laporan-kesehatan', $originalName);
            $validatedData['file'] = $path;
        }

        LaporanKesehatan::create($validatedData);
        return redirect('/admin/laporan-kesehatan')->with('success', 'Data Laporan Kesehatan Berhasil Ditambah!');
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
    public function edit(LaporanKesehatan $laporan_kesehatan)
    {
        return response()->view('admin.laporanKesehatan.edit', [
            'title' => 'Laporan Kesehatan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'laporan_kesehatan' => $laporan_kesehatan,
            'desa' => Desa::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaporanKesehatan $laporan_kesehatan)
    {
        $validatedData = $request->validate([
            'desa_id' => ['required', 'exists:desa,id'],
            'judul_laporan' => ['required'],
            'deskripsi' => ['required'],
            'file' => ['nullable', 'file', 'max:20480']
        ]);
        if ($request->file('file')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('file-laporan-kesehatan', $originalName);
            $validatedData['file'] = $path;
        }

        LaporanKesehatan::where('id', $laporan_kesehatan->id)
            ->update($validatedData);
        return redirect('/admin/laporan-kesehatan')->with('success', 'Data Laporan Kesehatan Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaporanKesehatan $laporan_kesehatan)
    {
        if ($laporan_kesehatan->file) {
            Storage::delete($laporan_kesehatan->file);
        }
        LaporanKesehatan::destroy($laporan_kesehatan->id);
        return redirect('/admin/laporan-kesehatan')->with('success', 'Data Laporan Kesehatan Berhasil Dihapus!');
    }
}
