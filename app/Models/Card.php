<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'oracle_id',
        'name',
        'cmc',
        'type_line',
        'mana_cost',
        'edhrec_rank',
    ];


    public function cardPrints(): HasMany
    {
        return $this->hasMany(CardPrint::class);
    }


    public function cardFaces(): HasManyThrough
    {
        return $this->hasManyThrough(CardFace::class, CardPrint::class);
    }


    public function sets()
    {
        return Set::find([$this->cardPrints()->get()->unique('set_id')->pluck('set_id')]);
    }


    public function colorIdentity(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'card_color_identity')->withTimestamps();
    }


    public function producedMana(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'card_produced_mana')->withTimestamps();
    }
}
