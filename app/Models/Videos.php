<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    protected $fillable = [
        'lesson_id',
        'title',
        'video_url',
        'duration',
    ];
}
