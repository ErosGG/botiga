<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Playability extends Pivot
{

    public function cardPrint(): BelongsTo
    {
        return $this->belongsTo(CardPrint::class);
    }
}
