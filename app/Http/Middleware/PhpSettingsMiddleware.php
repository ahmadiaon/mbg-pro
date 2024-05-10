<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PhpSettingsMiddleware
{

    public function handle($request, Closure $next)
    {
        ini_set('max_input_vars', 2000); // Adjust value as needed
        return $next($request);
    }
}
