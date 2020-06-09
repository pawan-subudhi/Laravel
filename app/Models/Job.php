<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by Pawan on 08/06/2020
 */
class Job extends Model
{
    protected $guarded = [];

    /**
     * as slug can not be accessed directly so we are defining this function    
     */
    public function getRouteKeyName(){
        return 'slug';
    }

    /**
     * relationship with company(i.e many jobs belong to same company)    
     */
    public function company(){
        return $this->belongsTo('App\Company');
    }

    /**
     * Relationship for users    
     */
    public function users(){
        return $this->belongsToMany(User::class)->withTimeStamps();
    }
    
    /**
     * helper function to check the user is already applied for the particular job or not     
     */
    public function checkApplication(){
        return \DB::table('job_user')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();
    }

    /**
     * helper function to check the user is already favourited for the particular job or not     
     */
    public function favourites(){
        return $this->belongsToMany(Job::class,'favourites','job_id','user_id')->withTimeStamps();
    }

    /**
     * check if the user id is present in the favorites table or not    
     */
    public function checkSaved(){
        return \DB::table('favourites')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();
    }

    /**
     * Relationships b/w likes and users         
     */
    public function likes(){
        return $this->belongsToMany(Job::class,'likes','job_id','user_id')->withTimeStamps();
    }

    /**
     * check if the user id is present in the likes table or not    
     */
    public function checkLiked(){
        return \DB::table('likes')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();
    }

    /**
     * Relationships b/w jobs and comments        
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
 