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


    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class, 'card_format_legality');
    }


    public function formats(): BelongsToMany
    {
        return $this->belongsToMany(Format::class, 'card_format_legality');
    }
}
