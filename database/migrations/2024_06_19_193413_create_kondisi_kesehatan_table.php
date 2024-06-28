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
        Schema::create('kondisi_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->string('pasien_id');
            $table->unsignedBigInteger('penyakit_id');
            $table->dateTime('waktu_terdeteksi');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('pasien_id')->references('id')->on('pasien')->onDelete('cascade');
            $table->foreign('penyakit_id')->references('id')->on('penyakit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kondisi_kesehatan');
    }
};
