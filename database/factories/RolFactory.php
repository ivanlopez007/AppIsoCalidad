<?php

namespace Database\Factories;

use App\Models\Rol;
use Illuminate\Database\Eloquent\Factories\Factory;

class RolFactory extends Factory
{
    protected $model = Rol::class;

    // Propiedad estática para llevar el control de cuál rol toca registrar
    protected static array $roles = ['admin', 'calidad', 'colaborador'];
    protected static int $index = 0;

    public function definition(): array
    {
        // Obtenemos el rol actual según el índice
        $nombreRol = self::$roles[self::$index % count(self::$roles)];

        // Incrementamos el índice para la siguiente vez que se llame al factory
        self::$index++;

        return [
            'nombre' => $nombreRol,
        ];
    }
}
