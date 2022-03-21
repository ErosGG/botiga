<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\CardFace;
use App\Models\CardPrint;
use App\Models\Discount;
use App\Models\Price;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '1G');

        $oracle = Storage::disk('local')->get('/public/oracle.json');

        $formatIds = DB::table('formats')->pluck('id', 'format');

        $legalityIds = DB::table('legalities')->pluck('id', 'legality');

        $typesIds = DB::table('types')->pluck('id', 'type');

        $colorsIds = DB::table('colors')->pluck('id', 'color');

        $setsIds = DB::table('sets')->pluck('id', 'code');

        foreach (array_slice(json_decode($oracle), 0, 10) as $objectData) {
            $card = Card::factory()
                ->create([
                    'oracle_id' => $objectData->oracle_id,
                    'name' => $objectData->name,
                    'cmc' => $objectData->cmc,
                    'type_line' => $objectData->type_line,
                    'mana_cost' => $objectData->mana_cost ?? null,
    //                'produced_mana' => $objectData->produced_mana ?? null,
                    'edhrec_rank' => $objectData->edhrec_rank ?? null,
            ]);

            $cardPrint = CardPrint::factory()
                ->has(Price::factory())->has(Stock::factory())
                ->create([
                    'card_id' => $card->id,
                    'set_id' => $setsIds[$objectData->set],
                    'scryfall_id' => $objectData->id,
                    'released_at' => $objectData->released_at ?? null,
                    'lang' => $objectData->lang,
                ]);

            if (property_exists($objectData, 'card_faces')) {
                $i = 0;
                foreach ($objectData->card_faces as $faceObject) {
                    $cardFace = CardFace::factory()
                        ->create([
                            'card_print_id' => $cardPrint->id,
                            'multiverse_id' => $objectData->multiverse_id[$i] ?? null,
                            'name' => $faceObject->name,
                            'mana_cost' => $faceObject->mana_cost,
                            'type_line' => $faceObject->type_line,
                            'power' => $faceObject->power ?? null,
                            'toughness' => $faceObject->toughness ?? null,
                            'oracle_text' => $faceObject->oracle_text ?? null,
                        ]);
                }
            } else {
                $cardFace = CardFace::factory()
                    ->create([
                        'card_print_id' => $cardPrint->id,
                        'multiverse_id' => $objectData->multiverse_id[0] ?? null,
                        'name' => $objectData->name,
                        'mana_cost' => $objectData->mana_cost,
                        'type_line' => $objectData->type_line,
                        'power' => $objectData->power ?? null,
                        'toughness' => $objectData->toughness ?? null,
                        'oracle_text' => $objectData->oracle_text ?? null,
                    ]);
            }


            foreach ($objectData->legalities as $format => $legality) {
                $cardPrint->formats()->attach($formatIds[$format], ['legality_id' => $legalityIds[$legality]]);
//                $now = now();
//                DB::table('playabilities')->insert([
//                    'card_print_id' => $cardPrint->id,
//                    'format_id' => $formatIds[$format],
//                    'legality_id' => $legalityIds[$legality],
//                    'created_at' => $now,
//                    'updated_at' => $now,
//                ]);
            }

            foreach (explode(' ', $objectData->type_line) as $type) {
                if (array_key_exists($type, $typesIds->toArray())) {
                    $cardFace->types()->attach($typesIds[$type]);
                }
            }

            foreach ($objectData->colors ?? [] as $color) {
                $cardFace->colors()->attach($colorsIds[$color]);
            }

            foreach ($objectData->color_identity ?? [] as $color) {
                $card->colorIdentity()->attach($colorsIds[$color]);
            }

            foreach ($objectData->color_indicator ?? [] as $color) {
                $cardFace->colorIndicator()->attach($colorsIds[$color]);
            }

            foreach ($objectData->produced_mana ?? [] as $color) {
                $card->producedMana()->attach($colorsIds[$color]);
            }
        }
    }
}
