<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Content extends Model

{
    use HasFactory;
    protected $table = 'content';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image', 
        'created_by',
        'category_id'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
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
