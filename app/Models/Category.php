<?php

namespace App\Models;


use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    public function question(): BelongsToMany 
    {
        return $this->belongsToManyQuestions::class;
    }
}
