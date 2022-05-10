<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OfertaUsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'oferta_id' => $this->faker->randomDigitNotNull(),
            'user_id' => $this->faker->randomDigitNotNull()
        ];
    }
}
