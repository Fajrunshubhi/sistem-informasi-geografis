<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PusatKesehatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'desa_id',
        'nama_pusat_kesehatan',
        'alamat',
        'no_tlpn',
        'gambar',
        'latitude',
        'longitude'
    ];
    protected $with = ['desa'];
    protected $table = 'pusat_kesehatan';

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
