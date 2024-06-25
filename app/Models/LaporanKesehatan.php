<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKesehatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['desa'];
    protected $table = 'laporan_kesehatan';
    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
