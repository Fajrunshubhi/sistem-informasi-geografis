<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriFasilitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
    ];
    public function fasilitas_kesehatan()
    {
        return $this->hasMany(FasilitasKesehatan::class);
    }
}
