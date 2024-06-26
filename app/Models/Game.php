<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function statistics(): HasOne {
        return $this->hasOne(Statistics::class, 'game_id', 'user_id');
    }
}
