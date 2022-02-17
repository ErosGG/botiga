<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends Factory
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape(['price' => "float"])]
    public function definition(): array
    {
        return [
//            'price' => round(mt_rand()/mt_getrandmax(), 2)*mt_rand(1, 10),
            'price' => $this->faker->randomFloat(2, 0.01, 10.00),
        ];
    }
}
