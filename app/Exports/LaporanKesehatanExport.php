<?php

namespace App\Exports;

use App\Models\LaporanKesehatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanKesehatanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return LaporanKesehatan::latest()->get();
    }

    public function map($laporan_kesehatan): array
    {
        return [
            $laporan_kesehatan->id,
            $laporan_kesehatan->desa_id,
            $laporan_kesehatan->desa->nama_desa,
            $laporan_kesehatan->judul_laporan,
            $laporan_kesehatan->deskripsi,
            $laporan_kesehatan->file,
            $laporan_kesehatan->created_at,
            $laporan_kesehatan->updated_at
        ];
    }

    public function headings(): array
    {
        return ["ID", "ID Desa", "Nama Desa", "Judul Laporan", "Deskripsi", "Nama File", "Created at", "Updated at"];
    }
}
