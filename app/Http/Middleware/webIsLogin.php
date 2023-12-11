<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class webIsLogin
{
    
    public function handle(Request $request, Closure $next)
    {
        if(empty(session('user_authentication')->auth_login)){            
            return redirect()->intended('/web/login');
        }
        if( session('user_authentication') == '0'){            
            return redirect()->intended('/web/login');
        }
        return $next($request);
    }
}
