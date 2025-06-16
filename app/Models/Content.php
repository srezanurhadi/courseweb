<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Content extends Model
{
    protected $table = 'content';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image', // Ini untuk "featured image"
        'created_by',
        'category_id'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_contents')
            ->withPivot('order')
            ->withTimestamps();
    }

    public function images(): MorphMany
    {
        return $this->morphMany(UploadedImage::class, 'imageable');
    }
}
