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
        Schema::create('card_faces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_print_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('multiverse_id')->nullable();
            $table->string('name', 255);
            $table->string('mana_cost', 255);
            $table->string('type_line', 22);
            $table->string('power', 255)->nullable();
            $table->string('toughness', 255)->nullable();
            $table->text('oracle_text')->nullable();
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
        Schema::dropIfExists('card_faces');
    }
};
