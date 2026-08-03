<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukm extends Model
{
    use HasFactory;

    // Ini ngasih tau Laravel kalau kolom-kolom ini boleh diisi/diambil datanya
    protected $fillable = [
        'nama_ukm', 'kategori', 'gambar', 'deskripsi',
        'h01', 'h02', 'h03', 'h04', 'h05', 'h06', 'h07', 'h08', 
        'h09', 'h10', 'h11', 'h12', 'h13', 'h14', 'h15'
    ];
}