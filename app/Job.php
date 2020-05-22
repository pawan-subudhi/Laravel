<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];
    
    // the user id and comppany id are not coming from form so they need to be placed in fillable if it would have came from form then the gurded would have worked fine
    // protected $fillable = [
    //     'user_id',
    //     'company_id',
    // ];

    //as slug can not be accessed directly so we are defining this function
    public function getRouteKeyName(){
        return 'slug';
    }

    //relationship with company(i.e many jobs belong to same company)
    public function company(){
        return $this->belongsTo('App\Company');
    }

    //Relationship for users
    public function users(){
        return $this->belongsToMany(User::class)->withTimeStamps();
    }
    
    //helper function to check the user is already applied for the particular job or not 
    public function checkApplication(){
        return \DB::table('job_user')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();
    }

    //realtionships b/w jobs and users i.e a user can favourite many jobs 
    //here the writing style is diferent than compared to users realtion as ther laravel knows the pivot table name is what and andall as the rules are followed for writing the pivot table name but in this it's not so we are expilctly mentioning the tale name and id's
    public function favourites(){
        return $this->belongsToMany(Job::class,'favourites','job_id','user_id')->withTimeStamps();
    }

    //if the user id is present in the favorites table for particular job  id then show unsave else save button 
    public function checkSaved(){
        return \DB::table('favourites')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();
    }
}
