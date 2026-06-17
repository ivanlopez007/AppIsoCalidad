<?php

namespace Database\Factories;

use App\Models\Area;
use App\Models\Localidad;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            // Usamos Hash::make para mayor seguridad si no usas casts() en el modelo
            'password' => Hash::make('password'),

            // Si el Seeder no le pasa un ID de forma manual, el factory crea uno de cada catálogo en automático
            'rol_id' => Rol::factory(),
            'localidad_id' => Localidad::factory(),
            'area_id' => Area::factory(),

            // Por defecto, se crean sin jefe. El Seeder se encargará de enlazarlos después.
            'jefe_inmediato_id' => null,
        ];
    }
}
