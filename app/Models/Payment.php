<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Payment extends Model
{
    use HasFactory;


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }


//    public function user(): HasOneThrough
//    {
//        return $this->hasOneThrough(User::class, Order::class);
//    }
}
