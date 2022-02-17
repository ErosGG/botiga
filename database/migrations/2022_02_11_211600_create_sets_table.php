<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->uuid('scryfall_id');
            $table->string('code', 255);
            $table->string('name', 255);
            $table->date('released_at')->nullable();
            $table->uuid('block_code')->nullable();
            $table->string('block', 255)->nullable();
            $table->string('parent_set_code', 5)->nullable();
            $table->integer('card_count');
            $table->enum('set_type', [
                'core', 'expansion', 'masters', 'alchemy', 'masterpiece',
                'arsenal', 'from_the_vault', 'spellbook', 'premium_deck', 'duel_deck',
                'draft_innovation', 'treasure_chest','commander', 'planechase', 'archenemy',
                'vanguard', 'funny', 'starter', 'box', 'promo',
                'token', 'memorabilia',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sets');
    }
};
