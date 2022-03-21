<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Format extends Model
{
    use HasFactory;


//    public function cardPrints(): BelongsTo
//    {
//        return $this->belongsTo(CardPrint::class);
//    }


    public function cardPrints(): BelongsToMany
    {
        return $this->belongsToMany(CardPrint::class, 'playabilities')
            ->using(Playability::class)
            ->withPivot('legality_id')
            ->withTimestamps();
    }


    public function legalities(): BelongsToMany
    {
        return $this->belongsToMany(Legality::class, 'playabilities')
            ->using(Playability::class)
            ->withPivot('card_print_id')
            ->withTimestamps();
    }
}
