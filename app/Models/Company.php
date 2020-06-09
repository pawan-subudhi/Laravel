<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by Pawan on 08/06/2020
 */
class Company extends Model
{
    protected $fillable = [
        'cname',
        'user_id',
        'slug',
        'address',
        'phone',
        'website',
        'logo',
        'cover_photo',
        'slogan',
        'description',
    ];

    /**
     * Relationship with job (i.e a company can have many jobs)    
     */
    public function jobs(){
        return $this->hasMany('App\Models\Job');
    }

    /**
     * as slug can not be accessed directly so we are defining this function    
     */
    public function getRouteKeyName(){
        return 'slug';
    }
}
