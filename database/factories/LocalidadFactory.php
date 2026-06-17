<?php

namespace Database\Factories;

use App\Models\Localidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Localidad>
 */
class LocalidadFactory extends Factory
{
    protected $model = Localidad::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Genera nombres de ciudades únicos para tus sucursales
            'localidad' => $this->faker->unique()->city(),
        ];
    }
}
