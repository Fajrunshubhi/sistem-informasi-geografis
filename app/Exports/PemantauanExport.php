<?php

namespace App\Exports;

use App\Models\Pemantauan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PemantauanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Pemantauan::latest()->get();
    }

    public function map($pemantauan): array
    {
        return [
            $pemantauan->id,
            $pemantauan->kondisi_kesehatan_id,
            $pemantauan->kondisi_kesehatan->pasien->desa->nama_desa,
            '="' . $pemantauan->kondisi_kesehatan->pasien->id . '"',
            $pemantauan->kondisi_kesehatan->pasien->nama,
            $pemantauan->kondisi_kesehatan->pasien->umur,
            $pemantauan->kondisi_kesehatan->pasien->jenis_kelamin,
            $pemantauan->kondisi_kesehatan->pasien->no_tlpn,
            $pemantauan->kondisi_kesehatan->pasien->alamat,
            $pemantauan->kondisi_kesehatan->penyakit->nama_penyakit,
            $pemantauan->kondisi_kesehatan->penyakit->deskripsi,
            $pemantauan->kondisi_kesehatan->penyakit->gejala,
            $pemantauan->kondisi_kesehatan->penyakit->metode_pengobatan,
            $pemantauan->kondisi_kesehatan->penyakit->tindakan_pencegahan,
            $pemantauan->tingkat_keparahan,
            $pemantauan->keterangan,
            $pemantauan->kondisi_kesehatan->latitude,
            $pemantauan->kondisi_kesehatan->longitude,
            $pemantauan->created_at,
            $pemantauan->updated_at
        ];
    }

    public function headings(): array
    {
        return ["ID Pemantauan", "ID Kondisi Kesehatan", "Nama Desa", "ID Pasien", "Nama Pasien", "Umur", "Jenis Kelamin", "No HP", "Alamat", "Penyakit", "Deskripsi", "Gejala", "Metode Pengobatan", "Tindakan Pencegahan", "Tingkat Keparahan", "Keterangan", "Latitude", "Longitude", "Created at", "Updated at"];
    }
}
