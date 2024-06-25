<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemantauan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['kondisi_kesehatan'];
    protected $table = 'pemantauan';

    public function kondisi_kesehatan()
    {
        return $this->belongsTo(KondisiKesehatan::class);
    }
}
