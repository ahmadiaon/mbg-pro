<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isLogistic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session('dataUser')){
            return redirect()->intended('/login');
        }
       
        if( session('dataUser.role') != 'logistic'){
            return redirect()->intended('/login');
        }
        return $next($request);
    }
}
