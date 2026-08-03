<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MeetingFilter
{
    protected Builder $builder;
    protected Request $request;

    // Field langsung dari tabel meetings
    protected array $filters = [
        'status',
        'meeting_time',
        'topics',
        'counselor_proposed_time'
    ];

    public function __construct(Builder $builder, Request $request)
    {
        $this->builder = $builder;
        $this->request = $request;
    }

    public function apply(): Builder
    {
        foreach ($this->filters as $field) {
            $value = $this->request->input($field);
            if (!empty($value)) {
                $this->builder->where($field, 'like', "%{$value}%");
            }
        }

        // filter dengan relasi
        if ($this->request->filled('student_name')) {
            $this->builder->whereHas('student', function ($q) {
                $q->where('name', 'like', '%' . $this->request->input('student_name') . '%');
            });
        }

        if ($this->request->filled('counselor_name')) {
            $this->builder->whereHas('counselor', function ($q) {
                $q->where('name', 'like', '%' . $this->request->input('counselor_name') . '%');
            });
        }

        if ($this->request->filled('counseling_type')) {
            $this->builder->whereHas('counselingType', function ($q) {
                $q->where('name', 'like', '%' . $this->request->input('counseling_type') . '%');
            });
        }

        return $this->builder;
    }
}
