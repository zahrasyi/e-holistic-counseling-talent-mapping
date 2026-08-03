<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserFilter
{
    protected Builder $builder;
    protected Request $request;

    protected array $filters = [
        'name',
        'username',
        'email',
        'phone',
        'gender',
        'address',
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

        return $this->builder;
    }
}
