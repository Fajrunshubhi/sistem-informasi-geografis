<?php

namespace App\Http\Controllers;

use App\Exports\PenyakitExport;
use App\Models\Penyakit;
use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class AdminPenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.penyakit.index', [
            'title' => 'Penyakit',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'penyakit' => Penyakit::latest()->get()
        ]);
    }

    public function export()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = now()->format('Y-m-d_His');
        $fileName = 'Penyakit_' . $currentDateTime . '.xlsx';
        return Excel::download(new PenyakitExport, $fileName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.penyakit.create', [
            'title' => 'Penyakit',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
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
            'warna' => ['required']
        ]);

        $exists = Penyakit::where('nama_penyakit', $validatedData['nama_penyakit'])
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors(['nama_penyakit' => 'Penyakit sudah ada!.']);
        }

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
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
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

        if ($request->warna != $penyakit->warna) {
            $request->validate(['warna' => ['required']]);
            $validatedData['warna'] = $request->warna;
        }
        $exists = Penyakit::where('nama_penyakit', $validatedData['nama_penyakit'])
            ->where('id', '!=', $penyakit->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors(['nama_penyakit' => 'Penyakit sudah ada!.']);
        }
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
