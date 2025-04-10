<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        $user = Session::get('api_user');
        
        if (!$user || $user['role'] !== 'Administrador') {
            return redirect()->route('home')->with('error', 'No tienes permisos para acceder a esta sección');
        }

        return $next($request);
    }
}