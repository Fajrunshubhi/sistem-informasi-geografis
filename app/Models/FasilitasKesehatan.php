<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasKesehatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['desa', 'kategori'];
    protected $table = 'fasilitas_kesehatan';
    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
    public function kategori()
    {
        return $this->belongsTo(KategoriFasilitas::class);
    }
}
