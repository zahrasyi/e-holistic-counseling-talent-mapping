<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ukms', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ukm');
            $table->string('kategori');
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            
            // 15 Kolom Bobot CF (Pastikan menggunakan tipe float)
            $table->float('h01')->default(0);
            $table->float('h02')->default(0);
            $table->float('h03')->default(0);
            $table->float('h04')->default(0);
            $table->float('h05')->default(0);
            $table->float('h06')->default(0);
            $table->float('h07')->default(0);
            $table->float('h08')->default(0);
            $table->float('h09')->default(0);
            $table->float('h10')->default(0);
            $table->float('h11')->default(0);
            $table->float('h12')->default(0);
            $table->float('h13')->default(0);
            $table->float('h14')->default(0);
            $table->float('h15')->default(0);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ukms');
    }
};