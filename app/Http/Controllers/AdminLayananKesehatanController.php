<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\LayananKesehatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AdminLayananKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.layananKesehatan.index', [
            'title' => 'Layanan Kesehatan',
            'layanan_kesehatan' => LayananKesehatan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.layananKesehatan.create', [
            'title' => 'Layanan Kesehatan',
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
            'nama_layanan' => ['required'],
            'alamat' => ['required'],
            'no_tlpn' => ['required'],
            'waktu_layanan' => ['required'],
            'gambar' => ['image', 'file', 'max:1024'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('layanan-kesehatan-images');
        }
        LayananKesehatan::create($validatedData);
        return redirect('/admin/data/layanan-kesehatan')->with('success', 'Data Layanan Kesehatan Berhasil Ditambah!');
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
    public function edit(LayananKesehatan $layanan_kesehatan)
    {
        return response()->view('admin.layananKesehatan.edit', [
            'title' => 'Layanan Kesehatan',
            'layanan_kesehatan' => $layanan_kesehatan,
            'desa' => Desa::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LayananKesehatan $layanan_kesehatan)
    {
        $validatedData = $request->validate([
            'desa_id' => ['required', 'exists:desa,id'],
            'nama_layanan' => ['required'],
            'alamat' => ['required'],
            'no_tlpn' => ['required'],
            'waktu_layanan' => ['required'],
            'gambar' => ['image', 'file', 'max:1024'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);
        if ($request->file('gambar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('layanan-kesehatan-images');
        }
        LayananKesehatan::where('id', $layanan_kesehatan->id)
            ->update($validatedData);

        return redirect('/admin/data/layanan-kesehatan')->with('success', 'Data Layanan Kesehatan Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LayananKesehatan $layanan_kesehatan)
    {
        if ($layanan_kesehatan->gambar) {
            Storage::delete($layanan_kesehatan->gambar);
        }
        LayananKesehatan::destroy($layanan_kesehatan->id);
        return redirect('/admin/data/layanan-kesehatan')->with('success', 'Data Layanan Kesehatan Berhasil Dihapus!');
    }
}
