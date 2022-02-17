<?php

use App\Http\Controllers\CardController;
use App\Models\Card;
use App\Models\Format;
use App\Models\Legality;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $oracle = Storage::disk('local')->get('/public/oracle.json');

//    dd(json_decode($oracle));

    $colors = [];
    $identityColors = [];
    $indicatorColors = [];
    $producedMana = [];

    foreach (json_decode($oracle) as $card) {
//        if (preg_match('/Forbidden Orchard/', $card->name)) {
//            dd($card);
//        }
//        if (property_exists($card, 'colors')) {
//            dump($i, 'trobat');
//            dd($card);
//        }
//        if (preg_match('/Daybreak Ranger/', $card->name)) dd($card);
        if (property_exists($card, 'colors')) {
            foreach ($card->colors as $color) {
                if (!in_array($color, $colors)) {
                    $colors[] = $color;
                }
            }
        }
        if (property_exists($card, 'color_identity')) {
            foreach ($card->color_identity as $identityColor) {
                if (!in_array($identityColor, $identityColors)) {
                    $identityColors[] = $identityColor;
                }
            }
        }
        if (property_exists($card, 'color_indicator')) {
            foreach ($card->color_indicator as $indicatorColor) {
                if (!in_array($indicatorColor, $indicatorColors)) {
                    $indicatorColors[] = $indicatorColor;
                }
            }
        }
        if (property_exists($card, 'produced_mana')) {
            foreach ($card->produced_mana as $mana) {
                if (!in_array($mana, $producedMana)) {
                    $producedMana[] = $mana;
                }
            }
        }
    }
    dump($colors);
    dump($identityColors);
    dump($indicatorColors);
    dump($producedMana);
    dd('Finalitzat');

    $resultats = DB::table('card_format_legality')
        ->where([
            'format_id' => 11,
            'legality_id' => 1,
        ])->pluck('card_id');
    dump($resultats);
    $cards = Card::find($resultats);
    dd($cards);

//    $commander = Format::where('format', 'commander')->first();
//    $legality = Legality::where('legality', 'legal')->first();
//    $commanderLegal = DB::table('card_format_legality')->where([
//        'format_id' => $commander->id,
//        'legality_id' => $legality->id,
//    ])->get();

    $legal = Legality::where('legality', 'legal')->first();
    $legalCommanderCards = Format::where('format', 'commander')
        ->first()
        ->cards()
        ->where('legality_id', $legal->id)
        ->get();
    dd($legalCommanderCards);

//    return view('welcome');
});


Route::get('/import-cards', [CardController::class, 'importCards']);


Route::get('/get-types', [CardController::class, 'getTypes']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
