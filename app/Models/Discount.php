<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Discount extends Model
{
    use HasFactory;


    public function cardPrint(): BelongsTo
    {
        return $this->belongsTo(CardPrint::class);
    }
}
