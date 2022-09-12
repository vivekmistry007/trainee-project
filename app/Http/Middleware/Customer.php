<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class Customer
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
        if (auth()->check() && (auth()->user()->action == 0)) {
            Auth::logout();
            return redirect('home')->with('error', ' sorry,You Are deactivate By Admin!');
        } else {
            return $next($request);
        }
    }   
}
