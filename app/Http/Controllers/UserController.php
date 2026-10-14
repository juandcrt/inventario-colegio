<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Listado y formulario de usuarios.
     * Solo admin/directiva.
     */
    public function index()
    {
        $users = User::orderBy('id')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Crear nuevo usuario.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'dni'      => 'required|string|max:20|unique:users,dni',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,directiva,bibliotecario,tic',
        ]);

        User::create([
            'name'     => $validated['name'],
            'dni'      => $validated['dni'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
            'permissions' => match($validated['role']) {
                'admin'         => json_encode(['inventory', 'library', 'tic']),
                'directiva'     => json_encode(['inventory', 'library', 'tic']),
                'bibliotecario' => json_encode(['library']),
                'tic'           => json_encode(['tic']),
                default         => json_encode([]),
            },
        ]);

        return redirect()->back()->with('success', '¡Usuario creado correctamente!');
    }

    /**
     * Actualizar rol de un usuario existente.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,directiva,bibliotecario,tic',
        ]);

        $user = User::findOrFail($id);

        // No permitir que el admin se quite su propio rol admin
        if ($user->id === auth()->id() && $validated['role'] !== 'admin') {
            return redirect()->back()->with('error', 'No puedes cambiar tu propio rol.');
        }

        $user->update([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'permissions' => match($validated['role']) {
                'admin'         => json_encode(['inventory', 'library', 'tic']),
                'directiva'     => json_encode(['inventory', 'library', 'tic']),
                'bibliotecario' => json_encode(['library']),
                'tic'           => json_encode(['tic']),
                default         => json_encode([]),
            },
        ]);

        return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Resetear contraseña.
     */
    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Contraseña actualizada.');
    }

    /**
     * Eliminar usuario.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Usuario eliminado.');
    }
}