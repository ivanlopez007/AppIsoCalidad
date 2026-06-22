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
        // 1. Crear catálogos base independientes (RolFactory creará: admin, calidad, colaborador)
        $roles = Rol::factory()->count(3)->create();
        $localidades = Localidad::factory()->count(3)->create();
        $areas = Area::factory()->count(5)->create();

        // Guardamos los IDs específicos de cada rol para no errar
        $idAdmin = $roles->where('nombre', 'admin')->first()->id ?? $roles[0]->id;
        $idCalidad = $roles->where('nombre', 'calidad')->first()->id ?? $roles[1]->id;
        $idColaborador = $roles->where('nombre', 'colaborador')->first()->id ?? $roles[2]->id;

        // 2. Crear al Director General (Admin) y su información
        $director = Usuario::factory()->create([
            'email' => 'director@empresa.com',
            'rol_id' => $idAdmin, // Asignación explícita de Administrador
            'localidad_id' => $localidades->first()->id,
            'area_id' => $areas->first()->id,
            'jefe_inmediato_id' => null,
        ]);

        InfoUsuario::factory()->create([
            'usuario_id' => $director->id,
        ]);

        // 3. Crear Gerentes (Calidad - Reportan directamente al Director)
        $gerentes = Usuario::factory()->count(2)->create([
            'rol_id' => $idCalidad, // Asignación explícita de Calidad
            'localidad_id' => fn() => $localidades->random()->id,
            'area_id' => fn() => $areas->random()->id,
            'jefe_inmediato_id' => $director->id,
        ]);

        $gerentes->each(function ($gerente) {
            InfoUsuario::factory()->create([
                'usuario_id' => $gerente->id,
            ]);
        });

        // 4. Crear Empleados del staff (Colaboradores) y su información
        $empleados = Usuario::factory()->count(15)->create([
            'rol_id' => $idColaborador, // Ahora sí, todos los del staff nacen como 'colaborador'
            'localidad_id' => fn() => $localidades->random()->id,
            'area_id' => fn() => $areas->random()->id,
            'jefe_inmediato_id' => fn() => $gerentes->random()->id,
        ]);

        $empleados->each(function ($empleado) {
            InfoUsuario::factory()->create([
                'usuario_id' => $empleado->id,
            ]);
        });
    }
}
