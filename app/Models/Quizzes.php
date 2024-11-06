<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quizzes extends Model
{
    protected $fillable = [
        'course_id',
        'lesson_id',
        'quiz_url',
    ];
}
