<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'image',
        'status',
    ];

    // Mendefinisikan relasi bahwa Course ini dibuat oleh satu User (Author).
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Mendefinisikan relasi bahwa Course ini milik satu Category.
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function contents(): BelongsToMany
    {
        return $this->belongsToMany(Content::class, 'course_content')
            ->withPivot('order')
            ->orderBy('order');
    }
}
