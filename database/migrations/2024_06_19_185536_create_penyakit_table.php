<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyakit', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penyakit');
            $table->text('deskripsi');
            $table->enum('kategori', ['Menular', 'Tidak Menular']);
            $table->text('gejala');
            $table->text('metode_pengobatan');
            $table->text('tindakan_pencegahan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyakit');
    }
};
