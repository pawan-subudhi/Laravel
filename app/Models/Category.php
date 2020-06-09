<?php

namespace App\Models;

use App\Models\Job;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // relationships with jbs
    public function jobs(){
        return $this->hasMany(Job::class);
    }
}
