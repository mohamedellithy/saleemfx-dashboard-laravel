<?php

namespace App\Http\Middleware;

use Closure;

class ArabicInputConverter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       collect($request->all())->each(function($value, $key) {
            $value = convert($value);
            $request->merge([$key => $value]);
        });
        return $next($request);
    }
}
