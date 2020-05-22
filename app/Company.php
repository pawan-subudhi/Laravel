<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    //Relationship with job (i.e a company can have many jobs)
    public function jobs(){
        return $this->hasMany('App\Job');
    }

    //as slug can not be accessed directly so we are defining this function
    public function getRouteKeyName(){
        return 'slug';
    }
}
