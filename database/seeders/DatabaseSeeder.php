<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Area;
use App\Models\Localidad;
use App\Models\InfoUsuario;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear catálogos base independientes
        $roles = Rol::factory()->count(3)->create();
        $localidades = Localidad::factory()->count(3)->create();
        $areas = Area::factory()->count(5)->create();

        // 2. Crear al Director General y su información
        $director = Usuario::factory()->create([
            'email' => 'director@empresa.com',
            'rol_id' => $roles->first()->id,
            'localidad_id' => $localidades->first()->id,
            'area_id' => $areas->first()->id,
            'jefe_inmediato_id' => null,
        ]);

        // Creamos la info del director usando su ID recién generado
        InfoUsuario::factory()->create([
            'usuario_id' => $director->id,
        ]);

        // 3. Crear Gerentes (Reportan directamente al Director)
        $gerentes = Usuario::factory()->count(2)->create([
            'rol_id' => $roles->skip(1)->first()->id ?? $roles->first()->id,
            'localidad_id' => fn() => $localidades->random()->id,
            'area_id' => fn() => $areas->random()->id,
            'jefe_inmediato_id' => $director->id,
        ]);

        // Creamos la info para cada uno de los gerentes creados
        $gerentes->each(function ($gerente) {
            InfoUsuario::factory()->create([
                'usuario_id' => $gerente->id,
            ]);
        });

        // 4. Crear Empleados del staff y su información
        $empleados = Usuario::factory()->count(15)->create([
            'rol_id' => fn() => $roles->random()->id,
            'localidad_id' => fn() => $localidades->random()->id,
            'area_id' => fn() => $areas->random()->id,
            'jefe_inmediato_id' => fn() => $gerentes->random()->id,
        ]);

        // Creamos la info para cada uno de los 15 empleados
        $empleados->each(function ($empleado) {
            InfoUsuario::factory()->create([
                'usuario_id' => $empleado->id,
            ]);
        });
    }
}
