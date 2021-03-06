<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Manager
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
        if(Auth::check()){

            if(Auth::user()->isManager()){

                return $next($request);
            }
            else if(Auth::user()->isAdmin()){

                return $next($request);
            }

        }

        return redirect('/user/profile');
    }
}
