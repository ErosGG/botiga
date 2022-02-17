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
        Schema::create('card_print_format_legality', function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_print_id')->constrained()->onDelete('cascade');
            $table->foreignId('format_id')->constrained()->onDelete('cascade');
            $table->foreignId('legality_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('card_format_legality');
    }
};
