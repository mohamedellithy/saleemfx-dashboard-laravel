<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Middleware\StartSession;
class CheckIfHaveReferenceAffiliate
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
        if($request->query->has('reference_id')){
            session(['refrence_affiliate_id' => $request->query('reference_id')]);
        }
        return $next($request);
    }
}
