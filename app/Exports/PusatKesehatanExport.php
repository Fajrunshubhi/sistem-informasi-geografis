<?php

namespace App\Exports;

use App\Models\PusatKesehatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class PusatKesehatanExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return PusatKesehatan::latest()->get();
    }
    public function map($pusat_kesehatan): array
    {
        return [
            $pusat_kesehatan->id,
            $pusat_kesehatan->desa_id,
            $pusat_kesehatan->desa->nama_desa,
            $pusat_kesehatan->nama_pusat_kesehatan,
            $pusat_kesehatan->alamat,
            $pusat_kesehatan->no_tlpn,
            $pusat_kesehatan->gambar,
            $pusat_kesehatan->latitude,
            $pusat_kesehatan->longitude,
            $pusat_kesehatan->created_at,
            $pusat_kesehatan->updated_at
        ];
    }

    public function headings(): array
    {
        return ["ID", "ID Desa", "Nama Desa", "Nama Pusat Kesehatan", "Alamat", "No HP", "Gambar", "Latitude", "Longitude", "Created at", "Updated at"];
    }

    public function drawings()
    {
        $drawings = [];

        // Get all PusatKesehatan records
        $pusatKesehatans = PusatKesehatan::all();

        foreach ($pusatKesehatans as $index => $pusatKesehatan) {
            // Path to the image (adjust the path according to your setup)
            $gambarUrl = public_path('storage/' . $pusatKesehatan->gambar);

            // Check if the image file exists
            if (file_exists($gambarUrl)) {
                // Create a new Drawing object
                $drawing = new Drawing();
                $drawing->setName('Gambar ' . $pusatKesehatan->nama_pusat_kesehatan);
                $drawing->setDescription('Gambar ' . $pusatKesehatan->nama_pusat_kesehatan);
                $drawing->setPath($gambarUrl);
                $drawing->setHeight(100); // Set the height of the image in pixels
                $drawing->setCoordinates('G' . ($index + 2)); // Set the position where the image should appear (G2, G3, etc.)
                $drawings[] = $drawing;
            }
        }
        return $drawings;
    }
}
