<?php

namespace App\Models;

use App\Filters\MeetingFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'counselor_id',
        'counseling_type_id',
        'meeting_time',
        'counselor_proposed_time',
        'status',
        'topics',
        'student_notes',
        // 'counselor_notes',
        'approved_by',
        'kuesioner_id',
        'reflections',
        'reflection_results',
    ];

    protected $casts = [
        'meeting_time' => 'datetime',
        'reflections' => 'array',
        'reflection_results' => 'array',
    ];

    public function scopeFilter(Builder $builder, string $filterClass)
    {
        $filter = new $filterClass($builder, request());
        return $filter->apply();
    }

    public function counselingType(): BelongsTo
    {
        return $this->belongsTo(CounselingType::class, 'counseling_type_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function counselor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_by');
    }

    public function meetingReschedules(): HasMany
    {
        return $this->hasMany(RescheduleRequest::class, 'meeting_id');
    }

    // 1:1
    public function summary(): HasOne
    {
        return $this->hasOne(SessionSummary::class, 'meeting_id');
    }
}