<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananKesehatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['desa'];
    protected $table = 'layanan_kesehatan';


    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
