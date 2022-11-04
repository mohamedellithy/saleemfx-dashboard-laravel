<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
class LanguageSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(auth()->check()):
            app()->setLocale(auth()->user()->lang ?: 'ar');
        else:
            app()->setLocale(session('app_lang') ?: 'ar');
        endif;
        return $next($request);
    }
}
