<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaInformasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user'];
    protected $table = 'berita_informasi';


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
