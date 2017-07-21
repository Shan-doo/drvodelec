<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\App;

class CheckLocale
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
        if (session('locale')) {
            
            App::setLocale(session('locale'));
        }

        return $next($request);
    }
}
