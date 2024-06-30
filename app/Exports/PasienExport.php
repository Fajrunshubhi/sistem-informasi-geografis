<?php

namespace App\Exports;

use App\Models\Pasien;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PasienExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pasien::latest()->get();
    }
    public function map($pasien): array
    {
        return [
            '="' . $pasien->id . '"',
            $pasien->desa_id,
            $pasien->desa->nama_desa,
            $pasien->nama,
            $pasien->umur,
            $pasien->jenis_kelamin,
            $pasien->no_tlpn,
            $pasien->alamat,
            $pasien->created_at,
            $pasien->updated_at
        ];
    }
    public function headings(): array
    {
        return ["ID Pasien", "ID Desa", "Nama Desa", "Nama Pasien", "Umur", "Jenis Kelamin", "No HP", "Alamat", "Created at", "Updated at"];
    }
}
