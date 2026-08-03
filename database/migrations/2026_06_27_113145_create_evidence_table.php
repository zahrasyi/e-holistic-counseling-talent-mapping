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
        Schema::create('evidences', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel users (siapa yang punya portofolio ini)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Menyimpan nomor soal (berdasarkan kodemu sebelumnya)
            $table->integer('nomor_soal');
            
            // Menyimpan nama/path file yang di-upload
            $table->string('file_path');
            
            // Menyimpan nilai/skor dari bukti karya tersebut
            $table->integer('nilai')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidence');
    }
};
