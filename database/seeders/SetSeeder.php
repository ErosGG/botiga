<?php

namespace Database\Seeders;

use App\Models\Set;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class SetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(Storage::disk('local')->get('/public/sets.json'));

        foreach ($data->data as $setObject) {
            Set::create([
                'scryfall_id' => $setObject->id,
                'code' => $setObject->code,
                'name' => $setObject->name,
                'released_at' => $setObject->released_at,
                'block_code' => $setObject->block_code ?? null,
                'block' => $setObject->block ?? null,
                'parent_set_code' => $setObject->parent_set_code ?? null,
                'card_count' => $setObject->card_count,
                'set_type' => $setObject->set_type,
            ]);
        }
    }
}
