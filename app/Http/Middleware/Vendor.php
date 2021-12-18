<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Vendor
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
        }elseif(Auth::check() && (Auth::user()->user_type=='admin'||Auth::user()->user_type=='superadmin')){
            return redirect('admin/dashboard');
        }
        return $next($request);
    }
}
