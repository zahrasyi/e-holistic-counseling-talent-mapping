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
        Schema::create('talent_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_result_id')->constrained('talent_results')->onDelete('cascade');
            $table->foreignId('kuesioner_soal_id')->constrained('kuesioner_soals')->onDelete('cascade');
            $table->integer('nilai_jawaban'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talent_answers');
    }
};
