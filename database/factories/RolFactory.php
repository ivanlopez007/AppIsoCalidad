<?php

namespace Database\Factories;

use App\Models\Rol; // <-- Asegúrate de que apunte a tu modelo actual
use Illuminate\Database\Eloquent\Factories\Factory;

class RolFactory extends Factory
{
    // ESTA LÍNEA ES LA CLAVE: Vincula el factory directamente al modelo singular
    protected $model = Rol::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->jobTitle(),
        ];
    }
}