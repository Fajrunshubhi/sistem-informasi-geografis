<?php

namespace App\Exports;

use App\Models\LayananKesehatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class LayananKesehatanExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return LayananKesehatan::latest()->get();
    }

    public function map($layanan_kesehatan): array
    {
        return [
            $layanan_kesehatan->id,
            $layanan_kesehatan->desa_id,
            $layanan_kesehatan->desa->nama_desa,
            $layanan_kesehatan->nama_layanan,
            $layanan_kesehatan->alamat,
            $layanan_kesehatan->no_tlpn,
            $layanan_kesehatan->waktu_layanan,
            $layanan_kesehatan->gambar,
            $layanan_kesehatan->latitude,
            $layanan_kesehatan->longitude,
            $layanan_kesehatan->created_at,
            $layanan_kesehatan->updated_at
        ];
    }

    public function headings(): array
    {
        return ["ID", "ID Desa", "Nama Desa", "Nama Layanan Kesehatan", "Alamat", "No HP", "Waktu Layanan", "Gambar", "Latitude", "Longitude", "Created at", "Updated at"];
    }

    public function drawings()
    {
        $drawings = [];

        // Get all layanan_kesehatan records
        $layananKesehatans = LayananKesehatan::all();

        foreach ($layananKesehatans as $index => $layanan_kesehatan) {
            // Path to the image (adjust the path according to your setup)
            $gambarUrl = public_path('storage/' . $layanan_kesehatan->gambar);

            // Check if the image file exists
            if (file_exists($gambarUrl)) {
                // Create a new Drawing object
                $drawing = new Drawing();
                $drawing->setName('Gambar ' . $layanan_kesehatan->nama_pusat_kesehatan);
                $drawing->setDescription('Gambar ' . $layanan_kesehatan->nama_pusat_kesehatan);
                $drawing->setPath($gambarUrl);
                $drawing->setHeight(100); // Set the height of the image in pixels
                $drawing->setCoordinates('H' . ($index + 2)); // Set the position where the image should appear (G2, G3, etc.)
                $drawings[] = $drawing;
            }
        }
        return $drawings;
    }
}
