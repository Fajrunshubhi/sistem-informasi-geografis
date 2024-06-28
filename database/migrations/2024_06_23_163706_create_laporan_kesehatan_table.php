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
        Schema::create('laporan_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desa_id');
            $table->string('judul_laporan');
            $table->longText('deskripsi');
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('desa_id')->references('id')->on('desa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kesehatan');
    }
};
