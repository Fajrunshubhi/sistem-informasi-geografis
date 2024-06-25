<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminPasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return response()->view('admin.pasien.index', [
            'title' => 'Pasien',
            'pasien' => Pasien::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): Response
    {
        return response()->view('admin.pasien.create', [
            'title' => 'Pasien',
            'desa' => Desa::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id' => ['required', 'string'],
            'desa_id' => ['required', 'exists:desas,id'],
            'nama' => ['required'],
            'umur' => ['required', 'max:100'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'no_tlpn' => ['required'],
            'alamat' => ['required'],
        ]);
        logger()->info('Nilai ID sebelum menyimpan:', ['id' => $validatedData['id']]);
        Pasien::create($validatedData);
        return redirect('/admin/pasien')->with('success', 'Data Pasien Berhasil Ditambah!');
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
    public function edit(Pasien $pasien)
    {
        return response()->view('admin.pasien.edit', [
            'title' => 'Pasien',
            'pasien' => $pasien,
            'desa' => Desa::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        $validatedData = $request->validate([
            'id' => ['required:string'],
            'desa_id' => ['required', 'exists:desas,id'],
            'nama' => ['required'],
            'umur' => ['required', 'max:100'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'no_tlpn' => ['required'],
            'alamat' => ['required'],
        ]);

        Pasien::where('id', $pasien->id)
            ->update($validatedData);

        return redirect('/admin/pasien')->with('success', 'Data Pasien Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        Pasien::destroy($pasien->id);
        return redirect('/admin/pasien')->with('success', 'Data Pasien Berhasil Dihapus!');
    }
}
