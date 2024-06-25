<?php

namespace App\Http\Controllers;

use App\Models\KondisiKesehatan;
use App\Models\Pemantauan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class AdminPemantauanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.pemantauan.index', [
            'title' => 'Pemantauan',
            'pemantauan' => Pemantauan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.pemantauan.create', [
            'title' => 'Pemantauan',
            'kondisi_kesehatan' => KondisiKesehatan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kondisi_kesehatan_id' => [
                'required', 'exists:kondisi_kesehatan,id',
                Rule::unique('pemantauan')->where(function ($query) use ($request) {
                    return $query->where('kondisi_kesehatan_id', $request->kondisi_kesehatan_id);
                })
            ],
            'waktu_pemantauan' => ['required'],
            'tingkat_keparahan' => ['required', 'in:Ringan (Mild),Sedang (Moderate),Berat (Severe),Kritis (Critical)'],
            'keterangan' => ['required']
        ]);
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
