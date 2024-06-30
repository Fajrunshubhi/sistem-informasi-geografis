<?php

namespace App\Exports;

use App\Models\KondisiKesehatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KondisiKesehatanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return KondisiKesehatan::latest()->get();
    }

    public function map($kondisi_kesehatan): array
    {
        return [
            $kondisi_kesehatan->id,
            $kondisi_kesehatan->pasien->desa_id,
            $kondisi_kesehatan->pasien->desa->nama_desa,
            '="' . $kondisi_kesehatan->pasien_id . '"',
            $kondisi_kesehatan->pasien->nama,
            $kondisi_kesehatan->pasien->umur,
            $kondisi_kesehatan->pasien->jenis_kelamin,
            $kondisi_kesehatan->pasien->no_tlpn,
            $kondisi_kesehatan->pasien->alamat,
            $kondisi_kesehatan->penyakit_id,
            $kondisi_kesehatan->penyakit->nama_penyakit,
            $kondisi_kesehatan->penyakit->deskripsi,
            $kondisi_kesehatan->penyakit->kategori,
            $kondisi_kesehatan->penyakit->gejala,
            $kondisi_kesehatan->penyakit->metode_pengobatan,
            $kondisi_kesehatan->latitude,
            $kondisi_kesehatan->longitude,
            $kondisi_kesehatan->created_at,
            $kondisi_kesehatan->updated_at
        ];
    }

    public function headings(): array
    {
        return ["ID", "ID Desa", "Nama Desa", "ID Pasien", "Nama Pasien", "Umur", "Jenis Kelamin", "No HP", "Alamat", "ID Penyakit", "Nama Penyakit", "Deskripsi Penyakit", "Kategori Penyakit", "Gejala", "Metode Pengobatan", "Latitude", "Longitude", "Created at", "Updated at"];
    }
}
