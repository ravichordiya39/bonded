<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->user_type=='user'){
            return redirect('user/dashboard');
        }elseif(Auth::check() && Auth::user()->user_type=='vendor'){
            return redirect('vendor/dashboard');
        }
        return $next($request);
    }
}
