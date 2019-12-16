<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class Dean
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
        if(!Auth::check()) {
            return redirect('/login');
        }
        if (Auth::check() && Auth::user()->role == 'dean') {
            return $next($request);
        }
        elseif (Auth::check() && Auth::user()->role == 'instructor') {
            return redirect('/instructor');
        }
        else {
            return redirect('/admin');
        }

    }
}
