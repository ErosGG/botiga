<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birthdate' => $this->faker->date(),
            'sex' => ['male', 'female', 'other', 'N/A', null][mt_rand(0, 4)],
            'telephone' => $this->faker->numerify('6########'),
            'description' => $this->faker->realText(),
        ];
    }
}
