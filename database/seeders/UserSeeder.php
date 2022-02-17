<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\PaymentCard;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(Profile::factory([
                'first_name' => 'Nom',
                'last_name' => 'Cognom1 i Cognom2',
                'birthdate' => new Carbon('1980/01/01'),
                'sex' => 'male',
                'telephone' => '612345678',
            ]))
            ->has(Address::factory([
                'name' => 'Casa',
                'address' => 'Carrer Gran, 123, 1r 2a',
                'telephone' => '612345678',
            ]))
            ->has(PaymentCard::factory())
            ->create([
                'email' => 'admin@gbotiga.cat',
        ]);

        User::factory()
            ->count(10)
            ->has(Profile::factory())
            ->has(Address::factory())
            ->has(PaymentCard::factory())
            ->create();
    }
}
