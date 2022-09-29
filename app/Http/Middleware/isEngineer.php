<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isEngineer
{
    public function handle(Request $request, Closure $next)
    {
        // dd(session('dataUser.role'));
        if(!session('dataUser')){
            return redirect()->intended('/login');
        }
       
        if( session('dataUser.role') != 'engineer'){
            return redirect()->intended('/login');
        }
        return $next($request);
    }
}
