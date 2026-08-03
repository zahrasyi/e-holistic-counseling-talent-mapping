<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'tipe_kuesioner', 'kategori_dominan', 'skor_cf_tertinggi', 'detail_skor'];

    public function answers()
    {
        return $this->hasMany(TalentAnswer::class);
    }
}