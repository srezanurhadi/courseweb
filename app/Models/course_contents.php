<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class course_contents extends Model
{
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Mendapatkan konten dari relasi ini.
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
