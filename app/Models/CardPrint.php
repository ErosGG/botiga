<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use phpDocumentor\Reflection\Types\This;


class CardPrint extends Model
{
    use HasFactory;


    protected $fillable = [
        'card_id',
        'set_id',
        'scryfall_id',
        'released_at',
        'lang',
    ];


    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }


    public function cardFaces(): HasMany
    {
        return $this->hasMany(CardFace::class);
    }


    public function set(): HasOne
    {
        return $this->hasOne(Set::class);
    }


//    public function formats(): HasMany
//    {
//        return $this->hasMany(Format::class);
//    }


    public function formats(): BelongsToMany
    {
        return $this->belongsToMany(Format::class, 'playabilities')
            ->using(Playability::class)
            ->withPivot('legality_id')
            ->withTimestamps();
    }


    public function legalities(): BelongsToMany
    {
        return $this->belongsToMany(Legality::class, 'playabilities')
            ->using(Playability::class)
            ->withPivot('format_id')
            ->withTimestamps();
    }


    public function playabilities(): HasMany
    {
        return $this->hasMany(Playability::class);
    }


    public function stock(): HasOne
    {
        return $this->hasOne(Stock::class);
    }


    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }


    public function latestPrice(): HasOne
    {
        return $this->hasOne(Price::class)->latestOfMany();
    }


    public function discounts(): HasMany
    {
        return $this->hasMany(Discount::class);
    }


    public function latestDiscount(): HasOne
    {
        return $this->hasOne(Discount::class)->latestOfMany();
    }


    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
