<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


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


    public function colorIdentity(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'card_color_identity')->withTimestamps();
    }


    public function producedMana(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'card_produced_mana')->withTimestamps();
    }
}
