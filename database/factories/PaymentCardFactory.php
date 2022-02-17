<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentCard>
 */
class PaymentCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'card_number' => Crypt::encryptString($this->faker->creditCardNumber()),
//            'expiration_date' => $this->faker->creditCardExpirationDateString(),
            'expiration_date' => Crypt::encryptString($this->faker->creditCardExpirationDateString),
            'provider' => $this->faker->creditCardType(),
        ];
    }
}
