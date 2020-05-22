<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //put something then it wont allow you to insert into the table
    protected $guarded =[];
    //protected $fillable = ['user_id','gender'];
}
