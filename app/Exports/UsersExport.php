<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::latest()->get();
    }
    public function map($user): array
    {
        return [
            $user->id,
            $user->desa_id,
            $user->desa->nama_desa,
            $user->nama,
            $user->email,
            $user->password,
            $user->role,
            $user->created_at,
            $user->updated_at
        ];
    }

    public function headings(): array
    {
        return ["ID", "ID Desa", "Nama Desa", "Nama", "Email", "Password", "Role", "Created at", "Updated at"];
    }
}
