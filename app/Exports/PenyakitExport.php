<?php

namespace App\Exports;

use App\Models\Penyakit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenyakitExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Penyakit::latest()->get();
    }

    public function map($penyakit): array
    {
        return [
            $penyakit->id,
            $penyakit->nama_penyakit,
            $penyakit->deskripsi,
            $penyakit->kategori,
            $penyakit->gejala,
            $penyakit->metode_pengobatan,
            $penyakit->tindakan_pencegahan,
            $penyakit->created_at,
            $penyakit->updated_at
        ];
    }

    public function headings(): array
    {
        return ["ID", "Nama Penyakit", "Deskripsi", "Kategori", "Gejala", "Metode Pengobatan", "Tindakan Pencegahan", "Created at", "Updated at"];
    }
}
