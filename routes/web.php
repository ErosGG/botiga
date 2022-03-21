<?php

use App\Http\Controllers\CardController;
use App\Models\Card;
use App\Models\CardPrint;
use App\Models\Format;
use App\Models\Legality;
use App\Models\Set;
use App\Models\User;
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
});


Route::get('/import-cards', [CardController::class, 'importCards']);


Route::get('/get-types', [CardController::class, 'getTypes']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
