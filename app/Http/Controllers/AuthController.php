<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Muestra el formulario de login
    public function showLogin()
    {
        // Si el usuario ya está autenticado, lo mandamos al dashboard
        if (Auth::check()) {
            return redirect()->intended('dashboard');
        }
        return view('auth.login');
    }

    // Procesa el intento de inicio de sesión
    public function login(Request $request)
    {
        // 1. Validar los datos de entrada
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Por favor, ingresa un correo válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        // 2. Intentar autenticar con la opción de "recordar" activa opcionalmente
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Regenerar la sesión por seguridad (evita fijación de sesiones)
            $request->session()->regenerate();

            // // redirecciona dependiendo del rol del usuario
            // $user = Auth::user();
            // if ($user->rol->nombre == 'admin') {
            //     return redirect()->intended('dash');
            // } elseif ($user->rol->nombre == 'calidad') {
            //     return redirect()->intended('calidad/dashboard');
            // } else {
            //     return redirect()->intended('dashboard');
            // }
            // // Redirecciona a la ruta que intentaba entrar o al dashboard por defecto
            return redirect()->intended('dashboard');
        }

        // 3. Si falla, regresar con un error específico
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email'); // Mantiene el correo escrito para comodidad del usuario
    }

    // Cierra la sesión del usuario
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidar y borrar tokens de la sesión actual
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
