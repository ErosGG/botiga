<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Set extends Model
{
    use HasFactory;


    public function cardPrints(): HasMany
    {
        return $this->hasMany(CardPrint::class);
    }
}
