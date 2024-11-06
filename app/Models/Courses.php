<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $fillable = [
        'instructor_id',
        'category_id',
        'title',
        'description',
        'price',
        'image'
    ];


}
