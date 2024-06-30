<?php

namespace App\Exports;

use App\Models\BeritaInformasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class BeritaExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BeritaInformasi::latest()->get();
    }

    public function map($berita_informasi): array
    {
        return [
            $berita_informasi->id,
            $berita_informasi->user->id,
            $berita_informasi->user->desa->nama_desa,
            $berita_informasi->user->nama,
            $berita_informasi->user->email,
            $berita_informasi->user->role,
            $berita_informasi->judul,
            $berita_informasi->isi,
            $berita_informasi->gambar,
            $berita_informasi->created_at,
            $berita_informasi->updated_at
        ];
    }

    public function headings(): array
    {
        return ["ID", "ID User", "Nama Desa", "Nama", "Email", "Role", "Judul", "Isi", "Gambar", "Created at", "Updated at"];
    }

    public function drawings()
    {
        $drawings = [];
        $berita = BeritaInformasi::all();

        foreach ($berita as $index => $berita_informasi) {
            // Path to the image (adjust the path according to your setup)
            $gambarUrl = public_path('storage/' . $berita_informasi->gambar);

            // Check if the image file exists
            if (file_exists($gambarUrl)) {
                // Create a new Drawing object
                $drawing = new Drawing();
                $drawing->setName('Gambar ' . $berita_informasi->judul);
                $drawing->setDescription('Gambar ' . $berita_informasi->judul);
                $drawing->setPath($gambarUrl);
                $drawing->setHeight(100); // Set the height of the image in pixels
                $drawing->setCoordinates('I' . ($index + 2)); // Set the position where the image should appear (G2, G3, etc.)
                $drawings[] = $drawing;
            }
        }
        return $drawings;
    }
}
