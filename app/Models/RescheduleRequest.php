<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RescheduleRequest extends Model
{
    protected $fillable = [
        'meeting_id',
        'requester_id',
        'new_meeting_time',
        'reason',
        'status'
    ];

    public function meetingReschedule(): BelongsTo
    {
        return $this->belongsTo(Meeting::class,  'meeting_id');
    }

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }
}
