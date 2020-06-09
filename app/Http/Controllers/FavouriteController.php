<?php

namespace App\Http\Controllers;

use App\Models\Job;

/**
 * This class is for saving a job and unsaving a job
 * Date: 08/06/2020
 * Author: Pawan
 */
class FavouriteController extends Controller
{    
    /**
     * saveJob 
     *
     * @param  int $id
     * @return bool
     */
    public function saveJob($id){
        $jobId = Job::find($id);
        // it will save 2 things in db one is job id and user id use attach method there is detach method too  for many to many relationships
        $jobId->favourites()->attach(auth()->user()->id);
    
        return 'true';
    }
    
    /**
     * unSaveJob
     *
     * @param  int $id
     * @return bool
     */
    public function unSaveJob($id){
        $jobId = Job::find($id);
        //we use detach to remove records from favourites table
        $jobId->favourites()->detach(auth()->user()->id);
    
        return 'true';
    }
}
