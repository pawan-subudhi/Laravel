<?php

namespace App;

use App\Job;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by Pawan on 08/06/2020
 */
class Category extends Model
{
    /**
     * relationships with jobs    
     */
    public function jobs(){
        return $this->hasMany(Job::class);
    }
}
