<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LessonVocabulary extends Pivot
{
    protected $table = 'lesson_vocabulary';

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function vocabulary(): BelongsTo
    {
        return $this->belongsTo(Vocabulary::class);
    }
}
