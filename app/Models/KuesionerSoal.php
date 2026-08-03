<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuesionerSoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe_kuesioner',
        'kategori_bakat',
        'kode',
        'pernyataan',
        'mb',
        'md',
        'cfp',
    ];
}