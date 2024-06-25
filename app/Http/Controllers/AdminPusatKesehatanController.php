<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\PusatKesehatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class AdminPusatKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.pusatKesehatan.index', [
            "title" => "Pusat Kesehatan",
            "pusat_kesehatan" => PusatKesehatan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Response $response): Response
    {
        return response()->view('admin.pusatKesehatan.create', [
            "title" => "Pusat Kesehatan",
            'desa' => Desa::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'desa_id' => ['required', 'exists:desas,id'],
            'nama_pusat_kesehatan' => ['required'],
            'alamat' => ['required'],
            'no_tlpn' => ['required'],
            'gambar' => ['image', 'file', 'max:1024'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ]);

        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('pusat-kesehatan-images');
        }
        PusatKesehatan::create($validatedData);
        return redirect('/admin/data/pusat-kesehatan')->with('success', 'Data Pusat Kesehatan Berhasil Ditambah');
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
    public function edit(PusatKesehatan $pusatKesehatan)
    {
        return response()->view('admin.pusatKesehatan.edit', [
            'title' => 'Pusat Kesehatan',
            'pusatKesehatan' => $pusatKesehatan,
            'desa' => Desa::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PusatKesehatan $pusatKesehatan)
    {
        $rules = [
            'desa_id' => ['required', 'exists:desas,id'],
            'nama_pusat_kesehatan' => ['required'],
            'alamat' => ['required'],
            'no_tlpn' => ['required'],
            'gambar' => ['image', 'file', 'max:1024'],
            'latitude' => ['required'],
            'longitude' => ['required'],
        ];
        $validatedData = $request->validate($rules);

        if ($request->file('gambar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('pusat-kesehatan-images');
        }
        PusatKesehatan::where('id', $pusatKesehatan->id)
            ->update($validatedData);
        return redirect('/admin/data/pusat-kesehatan')->with('success', 'Data Pusat Kesehatan Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PusatKesehatan $pusatKesehatan)
    {
        if ($pusatKesehatan->gambar) {
            Storage::delete($pusatKesehatan->gambar);
        }
        PusatKesehatan::destroy($pusatKesehatan->id);
        return redirect('/admin/data/pusat-kesehatan')->with('success', 'Data Pusat Kesehatan Berhasil Dihapus!');
    }
}
