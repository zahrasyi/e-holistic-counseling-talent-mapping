<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortofolioAnswer extends Model
{
    use HasFactory;

    // Kolom yang dizinkan untuk diisi secara massal
    protected $fillable = [
        'user_id',
        'nomor_soal',
        'kategori',
        'skor',
        'file_path',
    ];

    // Relasi ke tabel User (Opsional, tapi sangat berguna nanti)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}