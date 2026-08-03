<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Filters\UserFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'gender',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function scopeFilter(Builder $builder, UserFilter $userFilter)
    {
        $userFilter = new $userFilter($builder, request());
        return $userFilter->apply();
    }

    public function students(): HasMany
    {
        return $this->hasMany(Meeting::class, 'student_id');
    }

    public function counselors(): HasMany
    {
        return $this->hasMany(Meeting::class, 'counselor_id');
    }

    public function approvers(): HasMany
    {
        return $this->hasMany(Meeting::class, 'approver_by');
    }

    public function requesters(): HasMany
    {
        return $this->hasMany(RescheduleRequest::class, 'requester_id');
    }

    // M:M pivot counselor_specialization->Specializations
    public function specializations(): BelongsToMany
    {
        return $this->belongsToMany(Specialization::class, 'counselor_specialization', 'user_id', 'specialization_id');
    }

    public function counselorSummaries(): HasMany
    {
        return $this->hasMany(SessionSummary::class, 'counselor_id');
    }

    public function studentSummaries(): HasMany
    {
        return $this->hasMany(SessionSummary::class, 'student_id');
    }

    public function kuesioners(): HasMany
    {
        return $this->hasMany(Questionnaire::class, 'user_id');
    }

    public function counselor(): HasOne
    {
        return $this->hasOne(Counselor::class);
    }
}
