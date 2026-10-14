<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanEdit
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || !in_array($user->role, ['admin', 'directiva'])) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        return $next($request);
    }
}