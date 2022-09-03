<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isForeman
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
       
        if( session('dataUser.group') != 'foreman'){
            return redirect()->intended('/login');
        }
        return $next($request);
    }
}
