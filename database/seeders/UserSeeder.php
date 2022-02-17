<?php

namespace Database\Seeders;

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
                'first_name' => 'Eros',
                'last_name' => 'Gonzàlez i Garcia',
                'birthdate' => new Carbon('1987/02/14'),
                'sex' => 'male',
                'telephone' => '605525953',
            ]))
            ->create([
                'email' => 'gonzalez.eros@gmail.com',
        ]);

        User::factory()
            ->count(10)
            ->has(PaymentCard::factory())
            ->has(Profile::factory())
            ->create();
    }
}
