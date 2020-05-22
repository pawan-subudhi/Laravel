<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    //
    public function saveJob($id){
        $jobId = Job::find($id);
        // it will save 2 things in db one is job id and user id use attach method there is detach method too  for many to many relationships
        // or can use  create and pass the parameter 
        $jobId->favourites()->attach(auth()->user()->id);
        return redirect()->back();
    }

    public function unSaveJob($id){
        $jobId = Job::find($id);
        //we use detach to remove records from favourites table
        $jobId->favourites()->detach(auth()->user()->id);
        return redirect()->back();
    }
}
