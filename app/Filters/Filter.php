<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

interface Filter
{
    public function __construct(Request $request);

    public function apply(Builder $builder): Builder;

    public function filters(): Request;
}
