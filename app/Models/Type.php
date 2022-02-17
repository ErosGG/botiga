<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends Model
{
    use HasFactory;


    public function cardFaces(): BelongsToMany
    {
        return $this->belongsToMany(CardFace::class, 'card_face_type')->withTimestamps();
    }
}
