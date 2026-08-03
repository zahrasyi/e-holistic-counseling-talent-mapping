<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specializations extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    // M:M pivot counselor_specialization->User
    public function counselors(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'counselor_specialization', 'specialization_id', 'user_id');
    }
}
