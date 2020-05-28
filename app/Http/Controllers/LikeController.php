<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
    public function likeJob($id){
        $jobId = Job::find($id);
        // it will save 2 things in db one is job id and user id use attach method there is detach method too  for many to many relationships
        // or can use  create and pass the parameter 
        $jobId->likes()->attach(auth()->user()->id);
        // return redirect()->back();
        return 'true';
    }

    public function dislikeJob($id){
        $jobId = Job::find($id);
        //we use detach to remove records from favourites table
        $jobId->likes()->detach(auth()->user()->id);
        //return redirect()->back();
        return 'true';
    }
}
