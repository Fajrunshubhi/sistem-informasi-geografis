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
        Schema::create('pusat_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id');
            $table->string('nama_pusat_kesehatan');
            $table->string('alamat');
            $table->string('no_tlpn');
            $table->string('gambar')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pusat_kesehatan');
    }
};
