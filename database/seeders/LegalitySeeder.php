<?php

namespace Database\Seeders;

use App\Models\Legality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LegalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Legality::create(['legality' => 'legal',]);
        Legality::create(['legality' => 'not_legal',]);
        Legality::create(['legality' => 'restricted',]);
        Legality::create(['legality' => 'banned',]);
    }
}
