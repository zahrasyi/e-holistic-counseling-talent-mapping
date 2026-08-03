<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;

class Counselor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bio',
        'education_history',
        'profile_photo_path',
    ];

    protected $casts = [
        'education_history' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
