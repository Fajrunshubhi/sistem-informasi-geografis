<?php

namespace App\Exports;

use App\Models\ProfilKecamatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProfilKecamatanExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProfilKecamatan::all();
    }

    public function map($profil_kecamatan): array
    {
        return [
            $profil_kecamatan->id,
            $profil_kecamatan->nama,
            $profil_kecamatan->alamat,
            $profil_kecamatan->no_tlpn,
            $profil_kecamatan->email,
            $profil_kecamatan->deskripsi,
            $profil_kecamatan->latitude,
            $profil_kecamatan->longitude,
            $profil_kecamatan->created_at,
            $profil_kecamatan->updated_at
        ];
    }

    public function headings(): array
    {
        return ["ID", "Nama", "Alamat", "No HP", "Email", "Deskripsi", "Latitude", "Longitude", "Created at", "Updated at"];
    }
}
