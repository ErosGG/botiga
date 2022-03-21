<?php

namespace Database\Seeders;

use App\Models\ImageSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['small', 'normal', 'large'] as $size) {
            ImageSize::create(['size' => $size]);
        }
    }
}
