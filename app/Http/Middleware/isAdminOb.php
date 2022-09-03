<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;



class isAdminOb
{
    public function handle(Request $request, Closure $next)
    {
        if(!session('dataUser')){
            return redirect()->route('login');
        }
        
        if( session('dataUser')->group != 'admin-ob'){
            return redirect()->route('login');
        }
        return $next($request);
    }
}
