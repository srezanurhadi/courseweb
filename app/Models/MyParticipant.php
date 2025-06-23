<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyParticipant extends Model
{

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // ATAU jika MyParticipant langsung menggunakan enrollments
    public function enrolledUsers()
    {
        // Pastikan foreign key yang benar
        return $this->belongsToMany(User::class, 'enrollments', 'course_id', 'user_id')->withTimestamps();
    }
}
