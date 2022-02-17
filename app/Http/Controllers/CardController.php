<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Format;
use App\Models\Legality;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardRequest  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
    }


    public function importCards()
    {
        ini_set('max_execution_time', 0);

        $oracle = Storage::disk('local')->get('/public/oracle.json');

        $formatIds = DB::table('formats')->pluck('id', 'format');

        $legalityIds = DB::table('legalities')->pluck('id', 'legality');

        foreach (array_slice(json_decode($oracle), 0, 1000) as $cardData) {
            $card = Card::create([
                'scryfall_id' => $cardData->id,
                'oracle_id' => $cardData->oracle_id,
                'name' => $cardData->name,
                'cmc' => $cardData->cmc,
                'type_line' => $cardData->type_line,
                'mana_cost' => $cardData->mana_cost ?? null,
                'power' => $cardData->power ?? null,
                'toughness' => $cardData->toughness ?? null,
//                'produced_mana' => $cardData->produced_mana ?? null,
                'oracle_text' => $cardData->oracle_text ?? null,
                'lang' => $cardData->lang,
            ]);

            foreach ($cardData->legalities as $format => $legality) {
                $now = now();
                DB::table('card_format_legality')->insert([
                    'card_id' => $card->id,
                    'format_id' => $formatIds[$format],
                    'legality_id' => $legalityIds[$legality],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        return 'Importació finalitzada';
    }


    public function getTypes()
    {
        ini_set('max_execution_time', 0);

        $oracle = Storage::disk('local')->get('/public/oracle.json');

        $types = [];

        foreach (array_slice(json_decode($oracle), 0, 30000) as $cardData) {
            $faces = explode(' // ', $cardData->type_line);
            foreach ($faces as $face) {
                $faceTypes = explode(' — ', $face);
                foreach ($faceTypes as $type) {
                    $singleTypes = explode(' ', $type);
                    foreach ($singleTypes as $singleType) {
                        if (!in_array($singleType, $types)) $types[] = $singleType;
                    }
                }
            }
        }

        $oracle = Storage::disk('local')->put('/public/types.json', json_encode($types));

        dd($types);

        return 'Tipus determinats';
    }
}
