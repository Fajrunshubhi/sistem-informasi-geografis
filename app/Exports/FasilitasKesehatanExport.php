<?php

namespace App\Exports;

use App\Models\FasilitasKesehatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class FasilitasKesehatanExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return FasilitasKesehatan::latest()->get();
    }
    public function map($fasilitas_kesehatan): array
    {
        return [
            $fasilitas_kesehatan->id,
            $fasilitas_kesehatan->desa_id,
            $fasilitas_kesehatan->desa->nama_desa,
            $fasilitas_kesehatan->kategori->nama,
            $fasilitas_kesehatan->nama_fasilitas,
            $fasilitas_kesehatan->alamat,
            $fasilitas_kesehatan->no_tlpn,
            $fasilitas_kesehatan->gambar,
            $fasilitas_kesehatan->latitude,
            $fasilitas_kesehatan->longitude,
            $fasilitas_kesehatan->created_at,
            $fasilitas_kesehatan->updated_at
        ];
    }

    public function headings(): array
    {
        return ["ID", "ID Desa", "Nama Desa", "Kategori", "Nama Fasilitas Kesehatan", "Alamat", "No HP", "Gambar", "Latitude", "Longitude", "Created at", "Updated at"];
    }

    public function drawings()
    {
        $drawings = [];

        // Get all fasilitasKesehatan records
        $fasilitasKesehatans = FasilitasKesehatan::all();

        foreach ($fasilitasKesehatans as $index => $fasilitas_kesehatan) {
            // Path to the image (adjust the path according to your setup)
            $gambarUrl = public_path('storage/' . $fasilitas_kesehatan->gambar);

            // Check if the image file exists
            if (file_exists($gambarUrl)) {
                // Create a new Drawing object
                $drawing = new Drawing();
                $drawing->setName('Gambar ' . $fasilitas_kesehatan->nama_pusat_kesehatan);
                $drawing->setDescription('Gambar ' . $fasilitas_kesehatan->nama_pusat_kesehatan);
                $drawing->setPath($gambarUrl);
                $drawing->setHeight(100); // Set the height of the image in pixels
                $drawing->setCoordinates('H' . ($index + 2)); // Set the position where the image should appear (G2, G3, etc.)
                $drawings[] = $drawing;
            }
        }
        return $drawings;
    }
}
