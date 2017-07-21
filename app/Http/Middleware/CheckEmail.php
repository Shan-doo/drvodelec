<?php

namespace App\Http\Middleware;

use Closure;

class CheckEmail
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
        if ($request->expectsJson()) {

            if ($request->email != '') {
                
                if ($request->email !== config('app.email')) {
                
                    return response()->json(['email' => trans('passwords.user')], 422);

                }
            } else {

                return response()->json(['email' => trans('validation.required')], 422);
            }
        }  

        return $next($request);
     
    }
}
