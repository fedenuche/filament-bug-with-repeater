<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'objective',
        'coding_lang',
        'materials',
        'sort',
    ];

    public function lessonVocabulary(): HasMany
    {
        return $this->hasMany(LessonVocabulary::class);
    }
}
