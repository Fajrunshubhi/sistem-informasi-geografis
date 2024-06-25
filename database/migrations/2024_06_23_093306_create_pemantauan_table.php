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
        Schema::create('pemantauan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kondisi_kesehatan_id');
            $table->dateTime('waktu_pemantauan');
            $table->enum('tingkat_keparahan', ['Ringan (Mild)', 'Sedang (Moderate)', 'Berat (Severe)', 'Kritis (Critical)']);
            $table->longText('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemantauan');
    }
};
