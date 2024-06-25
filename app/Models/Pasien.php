<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $fillable  = [
        'id',
        'desa_id',
        'nama',
        'umur',
        'jenis_kelamin',
        'no_tlpn',
        'alamat'
    ];
    protected $with = ['desa'];
    protected $table = 'pasien';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
    public function kondisi_kesehatan()
    {
        return $this->belongsTo(KondisiKesehatan::class);
    }
}
