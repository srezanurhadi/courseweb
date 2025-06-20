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

    public function getRouteKeyName()
    {
        return 'slug';
    }


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
        return $this->belongsToMany(Content::class, 'course_contents')
            ->withPivot('order')
            ->orderBy('course_contents.order');
    }

    /**
     * Mendefinisikan relasi bahwa sebuah Course bisa memiliki banyak Pendaftaran (enrollments).
     */
    public function enrollments()
    {
        return $this->hasMany(enrollments::class, 'course_id');
    }

    /**
     * Mendapatkan semua progres dari semua pengguna di kursus ini.
     */
    public function progresses()
    {
        return $this->hasMany(UserCourseProgress::class);
    }
}
