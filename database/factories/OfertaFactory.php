<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OfertaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_oferta' => $this->faker->unique()->randomElement(['Desarrollador Java','Desarrollador Node JS','Desarrollador Php','FRONT-END','Desarrollador Phyton','Analista','Desarrollador Jr','Desarrollador Senior','FullStack']),
            'estado' => $this->faker->randomElement(['Activo','Inactivo'])
        ];
    }
}
