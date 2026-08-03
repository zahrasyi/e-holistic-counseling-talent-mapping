<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasFactory;
    protected $table = 'evidences';
    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'user_id',
        'nomor_soal',
        'file_path',
        'nilai',
    ];

    // Relasi ke User (Satu bukti karya milik satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}