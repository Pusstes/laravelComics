<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si usas Passport o Sanctum, puedes validar con Auth::check()
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return response()->json(['message' => 'No autorizado.'], 401);
        }

        return $next($request);
    }
}
