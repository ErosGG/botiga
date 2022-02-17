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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->uuid('oracle_id');
            $table->string('name', 255);
            $table->decimal('cmc', 10);
            $table->string('type_line', 255);
            $table->string('mana_cost', 255)->nullable();
            $table->unsignedBigInteger('edhrec_rank')->nullable();
//            $table->string('produced_mana', 255)->nullable();
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
        Schema::dropIfExists('cards');
    }
};
