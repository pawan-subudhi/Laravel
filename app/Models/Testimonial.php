<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //
    protected $fillable = [
        'content',
        'name',
        'profession',
        'video_id',
    ];
}
