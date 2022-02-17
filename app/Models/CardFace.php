<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class CardFace extends Model
{
    use HasFactory;


    protected $fillable = [
        'card_print_id',
        'multiverse_id',
        'name',
        'mana_cost',
        'type_line',
        'power',
        'toughness',
        'oracle_text',
    ];


    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'card_face_type')->withTimestamps();
    }


    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'card_face_color')->withTimestamps();
    }


    public function colorIndicator(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'card_color_indicator')->withTimestamps();
    }
}
