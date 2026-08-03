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
        Schema::create('portofolio_answers', function (Blueprint $table) {
            $table->id();
            // Menghubungkan jawaban dengan tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->integer('nomor_soal');
            $table->string('kategori'); // Isinya nanti: 'behavior' atau 'evidence'
            $table->integer('skor'); // Angka 1 sampai 5
            $table->string('file_path')->nullable(); // Alamat foto/file, boleh kosong (null)
            $table->timestamps();

            // KUNCI PENTING: Mencegah 1 user punya 2 jawaban untuk nomor soal yang sama.
            // Kalau user kembali ke halaman sebelumnya dan update jawaban, data lama akan tertimpa.
            $table->unique(['user_id', 'nomor_soal']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio_answers');
    }
};
