<?php

namespace App\Filters;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class QueryFilter implements Filter
{
		public Request $request;
		public Builder $builder;

		public function __construct(Request $request)
		{
			$this->request = $request;
		}

    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters()->all() as $fn => $parameter) {

            $fn = Str::camel($fn);

            if (method_exists($this, $fn)) {

                if (! is_array($parameter) && ! trim($parameter)) {
                    continue;
                }

                call_user_func([$this, $fn], $parameter);
            }
        }

        return $this->builder;
    }

    public function setParam($key, $value)
    {
        $this->request->merge([$key => $value]);
    }

    public function filters(): Request
    {
        return $this->request;
    }
}
