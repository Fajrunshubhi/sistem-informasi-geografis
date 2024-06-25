<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_desa',
        'warna',
        'geojson',
    ];

    public function pusat_kesehatan()
    {
        return $this->hasMany(PusatKesehatan::class);
    }
    public function fasilitas_kesehatan()
    {
        return $this->hasMany(FasilitasKesehatan::class);
    }
    public function layanan_kesehatan()
    {
        return $this->hasMany(LayananKesehatan::class);
    }
    public function kondisi_kesehatan()
    {
        return $this->hasMany(KondisiKesehatan::class);
    }
    public function pasien()
    {
        return $this->hasMany(Pasien::class);
    }
    public function laporan_kesehatan()
    {
        return $this->hasMany(LaporanKesehatan::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
