<?php

namespace App\Http\Controllers;

use App\Models\PreferenciaUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreferenciaUsuarioController extends Controller
{
    public function updateTema(Request $request)
    {
        try {
            // 1. Validar la entrada
            $request->validate([
                'tema' => 'required|in:light,dark'
            ]);

            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Usuario no autenticado'], 401);
            }

            //porque me sale error? 
            // 1. CORRECCIÓN: Usar la relación 'preferencias' definida en el modelo Usuario
            // 2. CORRECCIÓN: Usar 'updateOrCreate' para actualizar o crear la preferencia si no existe
            // 3. CORRECCIÓN: Asegurarse de que la relación 'preferencias' esté correctamente definida en el modelo Usuario
            // 4. CORRECCIÓN: 'usuario_id' es el nombre de tu columna relacional

            PreferenciaUsuario::updateOrCreate(
                ['usuario_id' => $user->id],
                ['tema' => $request->tema]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Preferencia de tema guardada con éxito'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getTraceAsString() // Nos dará el error exacto si falla SQL
            ], 500);
        }
    }
}
