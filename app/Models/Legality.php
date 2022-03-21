<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Legality extends Model
{
    use HasFactory;

    protected $fillable = [
        'legality',
    ];


    public function cardPrints(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'playabilities')
            ->using(Playability::class)
            ->withPivot('format_id')
            ->withTimestamps();
    }


    public function formats(): BelongsToMany
    {
        return $this->belongsToMany(Format::class, 'playabilities')
            ->using(Playability::class)
            ->withPivot('card_print_id')
            ->withTimestamps();
    }
}
