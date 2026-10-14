<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validamos que se envíe el DNI (8 dígitos) y la contraseña
        $credentials = $request->validate([
            'dni' => ['required', 'string', 'size:8'],
            'password' => ['required'],
        ]);

        // Intentamos autenticar usando 'dni' en lugar de 'email'
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Redirección al módulo principal de inventario de mobiliario
            return redirect()->intended(route('inventory.index'));
        }

        // Si falla, devolvemos el error asociado al campo dni
        return back()->withErrors([
            'dni' => 'Las credenciales introducidas no coinciden con nuestros registros.',
        ])->onlyInput('dni');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}