<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\FasilitasKesehatan;
use App\Models\KategoriFasilitas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AdminFasilitasKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.fasilitaskesehatan.index', [
            'title' => 'Fasilitas Kesehatan',
            'fasilitas_kesehatan' => FasilitasKesehatan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.fasilitaskesehatan.create', [
            'title' => 'Fasilitas Kesehatan',
            'desa' => Desa::all(),
            'kategori' => KategoriFasilitas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desa_id' => ['required', 'exists:desa,id'],
            'kategori_id' => ['required', 'exists:kategori_fasilitas,id'],
            'nama_fasilitas' => ['required'],
            'alamat' => ['required'],
            'no_tlpn' => ['required'],
            'gambar' => ['image', 'file', 'max:1024'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('fasilitas-kesehatan-images');
        }
        FasilitasKesehatan::create($validatedData);
        return redirect('/admin/data/fasilitas-kesehatan')->with('success', 'Data Fasilitas Kesehatan Berhasil Ditambah!');
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
    public function edit(FasilitasKesehatan $fasilitas_kesehatan)
    {
        return response()->view('admin.fasilitaskesehatan.edit', [
            'title' => 'Fasilitas Kesehatan',
            'fasilitas_kesehatan' => $fasilitas_kesehatan,
            'desa' => Desa::all(),
            'kategori' => KategoriFasilitas::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FasilitasKesehatan $fasilitas_kesehatan)
    {
        $validatedData = $request->validate([
            'desa_id' => ['required', 'exists:desa,id'],
            'kategori_id' => ['required', 'exists:kategori_fasilitas,id'],
            'nama_fasilitas' => ['required'],
            'alamat' => ['required'],
            'no_tlpn' => ['required'],
            'gambar' => ['image', 'file', 'max:1024'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        if ($request->file('gambar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('fasilitas-kesehatan-images');
        }

        FasilitasKesehatan::where('id', $fasilitas_kesehatan->id)
            ->update($validatedData);
        return redirect('/admin/data/fasilitas-kesehatan')->with('success', 'Data Fasilitas Kesehatan Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FasilitasKesehatan $fasilitas_kesehatan)
    {
        if ($fasilitas_kesehatan->gambar) {
            Storage::delete($fasilitas_kesehatan->gambar);
        }
        FasilitasKesehatan::destroy($fasilitas_kesehatan->id);
        return redirect('/admin/data/fasilitas-kesehatan')->with('success', 'Data Fasilitas Kesehatan Berhasil Dihapus!');
    }
}
