<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Color extends Model
{
    use HasFactory;


    public function cardFacesByColor(): BelongsToMany
    {
        return $this->belongsToMany(CardFace::class, 'card_face_color');
    }


    public function cardsByColorIdentity(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'card_color_identity')->withTimestamps();
    }


    public function cardFacesByColorIndicator(): BelongsToMany
    {
        return $this->belongsToMany(CardFace::class, 'card_face_color_indicator')->withTimestamps();
    }


    public function cardsByProducedMana(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'card_produced_mana')->withTimestamps();
    }
}
