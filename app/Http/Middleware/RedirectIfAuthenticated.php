<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware para redirigir usuarios autenticados lejos de rutas públicas.
 * 
 * @author Luis Miguel Álvarez <luismiguel.alvarez@humboldt.edu.co>
 */
class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return response()->json([
                    'message' => 'Ya estás autenticado.'
                ], 403);  // HTTP 403 Forbidden
            }
        }

        return $next($request);
    }
}
