<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TalentAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['talent_result_id', 'kuesioner_soal_id', 'nilai_jawaban'];

    public function result()
    {
        return $this->belongsTo(TalentResult::class, 'talent_result_id');
    }

    public function soal()
    {
        return $this->belongsTo(KuesionerSoal::class, 'kuesioner_soal_id');
    }
}