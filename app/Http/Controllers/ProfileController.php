<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Listar todos los perfiles y sus permisos actuales
    public function index()
    {
        // Validar que solo el administrador general o directiva puedan ver esta sección
        $user = auth()->user();
        if (!$user || !in_array($user->role, ['admin', 'directiva'])) {
            abort(403, 'Acceso denegado. No cuentas con los privilegios requeridos.');
        }

        $users = User::all();
        return view('profiles.index', compact('users'));
    }

    // Actualizar el rol y los módulos permitidos de un usuario
    public function updateAccess(Request $request, $id)
    {
        $currentUser = auth()->user();
        if (!$currentUser || !in_array($currentUser->role, ['admin', 'directiva'])) {
            abort(403, 'Acceso denegado.');
        }

        $targetUser = User::findOrFail($id);

        // Actualizar el rol principal (ej: 'admin', 'directiva', 'bibliotecario', 'tic', 'aip')
        $targetUser->role = $request->role;

        // Guardar los módulos permitidos que vienen marcados desde los checkboxes (ej: ['inventory', 'library', 'tic'])
        $targetUser->permissions = json_encode($request->permissions ?? []);
        $targetUser->save();

        return redirect()->route('profiles.index')->with('success', 'Accesos y roles actualizados correctamente para ' . $targetUser->name);
    }
}