<?php

namespace App\Exports;

use App\Models\Desa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DesaExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Desa::latest()->get();
    }
    public function map($desa): array
    {
        return [
            $desa->id,
            $desa->nama_desa,
            $desa->warna,
            $desa->geojson,
            $desa->created_at,
            $desa->updated_at
        ];
    }
    public function headings(): array
    {
        return ["ID", "Nama Desa", "Warna", "GeoJSON", "Created at", "Updated at"];
    }
}
