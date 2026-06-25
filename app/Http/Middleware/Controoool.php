<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthSession
{
    /**
     * Evalúa la petición entrante.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Usamos el Facade Auth para comprobar si el usuario NO ha iniciado sesión
        if (!Auth::check()) {
            // Si no está autenticado, lo redirigimos al formulario de login
            return redirect()->route('formlogin')->with('error', 'Debes iniciar sesión primero.');
        }

        // Si está autenticado, permitimos que la petición continúe a la ruta original
        return $next($request);
    }
}



<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventBackHistory
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Forzamos al navegador a destruir la caché de esta página
        return $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sun, 02 Jan 1990 00:00:00 GMT');
    }
}
