<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vocabulary extends Model
{
    use HasFactory;

    protected $fillable = [
        'term',
        'definition',
    ];

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class)->withTimestamps();
    }
}
