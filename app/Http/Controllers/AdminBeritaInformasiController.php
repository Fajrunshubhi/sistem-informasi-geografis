<?php

namespace App\Http\Controllers;

use App\Exports\BeritaExport;
use App\Models\BeritaInformasi;
use App\Models\ProfilKecamatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;


class AdminBeritaInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.beritaInformasi.index', [
            'title' => 'Berita dan Informasi',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'berita_informasi' => BeritaInformasi::whereHas('user', function ($query) {
                $query->where('desa_id', Auth()->user()->desa_id);
            })->latest()->get(),
        ]);
    }

    public function export()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = now()->format('Y-m-d_His');
        $fileName = 'Berita_Informasi_' . $currentDateTime . '.xlsx';
        return Excel::download(new BeritaExport, $fileName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.beritaInformasi.create', [
            'title' => 'Berita dan Informasi',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'user' => User::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => ['exists:user,id'],
            'judul' => ['required'],
            'gambar' => ['image', 'file', 'max:1024'],
            'isi' => ['required'],
        ]);
        if ($request->file('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('berita-informasi-images');
        }
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['slug'] = Str::slug($request->judul, '-');
        $validatedData['excerpt'] = Str::limit(strip_tags($request->isi), 150);

        BeritaInformasi::create($validatedData);
        return redirect('/admin/berita-informasi')->with('success', 'Data Berita dan Informasi Kesehatan Berhasil Ditambah!');
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
    public function edit(BeritaInformasi $berita_informasi)
    {
        return response()->view('admin.beritaInformasi.edit', [
            'title' => 'Berita dan Informasi',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'berita_informasi' => $berita_informasi,
            'user' => User::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BeritaInformasi $berita_informasi)
    {
        $validatedData = $request->validate([
            'user_id' => ['exists:user,id'],
            'judul' => ['required'],
            'gambar' => ['image', 'file', 'max:1024'],
            'isi' => ['required'],
        ]);
        if ($request->file('gambar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['gambar'] = $request->file('gambar')->store('berita-informasi-images');
        }

        $validatedData['user_id'] = $berita_informasi->user_id;
        BeritaInformasi::where('id', $berita_informasi->id)
            ->update($validatedData);
        return redirect('/admin/berita-informasi')->with('success', 'Data Berita dan Informasi Kesehatan Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BeritaInformasi $berita_informasi)
    {
        if ($berita_informasi->gambar) {
            Storage::delete($berita_informasi->gambar);
        }
        BeritaInformasi::destroy($berita_informasi->id);
        return redirect('/admin/berita-informasi')->with('success', 'Data Berita dan Informasi Kesehatan Berhasil Dihapus!');
    }
}
