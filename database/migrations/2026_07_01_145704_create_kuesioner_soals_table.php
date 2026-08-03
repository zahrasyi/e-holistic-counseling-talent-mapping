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
        Schema::create('kuesioner_soals', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_kuesioner'); // Isinya: 'penelusuran' atau 'aptitude'
            $table->string('kategori_bakat')->nullable(); // Misal: 'Bakat Kepemimpinan'
            $table->string('kode')->unique(); // Misal: 'G001'
            $table->text('pernyataan');
            $table->float('mb')->default(0); // Measure of Belief
            $table->float('md')->default(0); // Measure of Disbelief
            $table->float('cfp')->default(0); // CF Pakar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuesioner_soals');
    }
};
