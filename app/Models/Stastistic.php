<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stastistic extends Model
{
    use HasFactory;

    public function game(): BelongsTo {
        return $this->belongsTo(Game::class, 'game_id', 'user_id');
    }
}
