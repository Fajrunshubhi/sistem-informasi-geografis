<?php

namespace App\Http\Controllers;

use App\Exports\PemantauanExport;
use App\Models\KondisiKesehatan;
use App\Models\Pemantauan;
use App\Models\ProfilKecamatan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class AdminPemantauanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.pemantauan.index', [
            'title' => 'Pemantauan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'pemantauan' => Pemantauan::whereHas('kondisi_kesehatan', function ($query) {
                $query->whereHas('pasien', function ($query) {
                    $query->where('desa_id', Auth()->user()->desa_id);
                });
            })->latest()->get()
        ]);
    }

    public function export()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentDateTime = now()->format('Y-m-d_His');
        $fileName = 'Pemantauan_' . $currentDateTime . '.xlsx';
        return Excel::download(new PemantauanExport, $fileName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.pemantauan.create', [
            'title' => 'Pemantauan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'kondisi_kesehatan' => KondisiKesehatan::whereHas('pasien', function ($query) {
                $query->where('desa_id', Auth()->user()->desa_id);
            })->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kondisi_kesehatan_id' => [
                'required', 'exists:kondisi_kesehatan,id'
            ],
            'waktu_pemantauan' => ['required'],
            'tingkat_keparahan' => ['required', 'in:Ringan (Mild),Sedang (Moderate),Berat (Severe),Kritis (Critical)'],
            'keterangan' => ['required']
        ]);

        $exists = Pemantauan::where('kondisi_kesehatan_id', $validatedData['kondisi_kesehatan_id'])
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors(['kondisi_kesehatan_id' => 'Kondisi Kesehatan Dengan ID Ini Sudah Dilakukan Pemantauan!']);
        }
        Pemantauan::create($validatedData);
        return redirect('/admin/pemantauan')->with('success', 'Data Pemantauan Penyakit Berhasil Ditambah!');
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
    public function edit(Pemantauan $pemantauan)
    {
        return response()->view('admin.pemantauan.edit', [
            'title' => 'Pemantauan',
            'profil_kecamatan' => ProfilKecamatan::all()->find(1),
            'pemantauan' => $pemantauan,
            'kondisi_kesehatan' => KondisiKesehatan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemantauan $pemantauan)
    {
        $validatedData = $request->validate([
            'kondisi_kesehatan_id' => [
                'exists:kondisi_kesehatan,id'
            ],
            'waktu_pemantauan' => ['required'],
            'tingkat_keparahan' => ['required', 'in:Ringan (Mild),Sedang (Moderate),Berat (Severe),Kritis (Critical)'],
            'keterangan' => ['required']
        ]);

        $exists = Pemantauan::where('kondisi_kesehatan_id', $validatedData['kondisi_kesehatan_id'])
            ->where('id', '!=', $pemantauan->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->withErrors(['kondisi_kesehatan_id' => 'Kondisi Kesehatan Dengan ID Ini Sudah Dilakukan Pemantauan!']);
        }

        Pemantauan::where('id', $pemantauan->id)
            ->update($validatedData);
        return redirect('/admin/pemantauan')->with('success', 'Data Pemantauan Penyakit Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemantauan $pemantauan)
    {
        Pemantauan::destroy($pemantauan->id);
        return redirect('/admin/pemantauan')->with('success', 'Data Pemantauan Penyakit Berhasil Dihapus!');
    }
}
