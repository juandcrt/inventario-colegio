<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckModuleAccess
{
    public function handle(Request $request, Closure $next, $module)
    {
        $user = auth()->user();

        // Si es Admin General o Directiva, dar acceso total por defecto
        if (in_array($user->role, ['admin', 'directiva'])) {
            return $next($request);
        }

        // Decodificar permisos del usuario
        $permissions = json_decode($user->permissions ?? '[]', true);

        // Verificar si tiene acceso al módulo solicitado ('inventory', 'library', 'tic')
        if (in_array($module, $permissions)) {
            return $next($request);
        }

        return redirect()->route('inventory.dashboard')->with('error', 'No cuentas con autorización para acceder a este módulo institucional.');
    }
}