<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by Pawan on 08/06/2020
 */
class Testimonial extends Model
{

    protected $fillable = [
        'content',
        'name',
        'profession',
        'video_id',
    ];
}
