<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiKesehatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['pasien', 'penyakit'];
    protected $table = 'kondisi_kesehatan';

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
