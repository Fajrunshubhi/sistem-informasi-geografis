<?php

namespace App\Exports;

use App\Models\KategoriFasilitas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KategoriFasilitasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return KategoriFasilitas::latest()->get();
    }
    public function map($kategori_fasilitas): array
    {
        return [
            $kategori_fasilitas->id,
            $kategori_fasilitas->nama,
            $kategori_fasilitas->created_at,
            $kategori_fasilitas->updated_at
        ];
    }
    public function headings(): array
    {
        return ["ID Kategori", "Nama", "Created at", "Updated at"];
    }
}
