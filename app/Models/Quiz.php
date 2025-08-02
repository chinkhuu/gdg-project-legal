<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $guarded = [];


    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('id');
    }
}
