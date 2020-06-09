<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Company;
use App\Models\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type','google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relationship for profile
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    
    //Relationship for company
    public function company(){
        return $this->hasOne(Company::class);
    }

    //Relationship for favourited jobs user_id is primary key of this table and job_id is the foriegn key in our favourites table
    public function favourites(){
        return $this->belongsToMany(Job::class,'favourites','user_id','job_id')->withTimeStamps();
    }

    //Relationship for applied jobs user_id is primary key of this table and job_id is the foriegn key in our applied jobs table
    public function appliedJobs(){
        return $this->belongsToMany(Job::class,'job_user','user_id','job_id')->withTimeStamps();
    }

    //roles relationships
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

}
