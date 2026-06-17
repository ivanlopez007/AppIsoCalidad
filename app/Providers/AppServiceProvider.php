<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Si elegiste el Camino 1 (tabla en plural 'sessions'):
        config(['session.table' => 'sessions']);

        // 2. ¡LA SOLUCIÓN AQUÍ! Le decimos a Laravel que use tu columna en español
        config(['auth.providers.users.model' => \App\Models\Usuario::class]);

        // Adicionalmente, aseguramos el mapeo si usas el guard web tradicional
        config(['session.user_id_column' => 'usuario_id']);
    }
}
