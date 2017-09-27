<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        $id = $request->route('client_id');

        if(Auth::check()){

            if(Auth::user()->isAssigned($id)){

                return $next($request);
            }
        }

            return redirect('/user/profile');
    }
}
