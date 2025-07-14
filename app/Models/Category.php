<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    protected $fillable = [
        'category',
        'icon',
        'color',
    ];

    // Relasi ke Courses
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    // Relasi ke Contents
    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}
