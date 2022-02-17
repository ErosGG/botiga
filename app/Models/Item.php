<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Item extends Model
{
    use HasFactory;


    /**
     * Un Item pot pertànyer a Cart i a Order
     *
     * @return MorphTo
     */
    public function itemable(): MorphTo
    {
        return $this->morphTo();
    }


    public function cardPrint(): BelongsTo
    {
        return $this->belongsTo(CardPrint::class);
    }
}
