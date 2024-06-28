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
            $table->unsignedBigInteger('kondisi_kesehatan_id');
            $table->dateTime('waktu_pemantauan');
            $table->enum('tingkat_keparahan', ['Ringan (Mild)', 'Sedang (Moderate)', 'Berat (Severe)', 'Kritis (Critical)']);
            $table->longText('keterangan');
            $table->timestamps();

            $table->foreign('kondisi_kesehatan_id')->references('id')->on('kondisi_kesehatan')->onDelete('cascade');
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
