<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'content',
    ];
}
