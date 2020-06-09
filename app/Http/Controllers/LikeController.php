<?php

namespace App\Http\Controllers;

use App\Models\Job;

/**
 * This class is for liking and disliking a job
 * Date: 08/06/2020
 * Author: Pawan
 */
class LikeController extends Controller
{    
    /**
     * likeJob
     *
     * @param  int $id
     * @return bool
     */
    public function likeJob($id){
        $jobId = Job::find($id);
        // it will save 2 things in db one is job id and user id use attach method there is detach method too  for many to many relationships
        $jobId->likes()->attach(auth()->user()->id);
    
        return 'true';
    }
    
    /**
     * dislikeJob
     *
     * @param  int $id
     * @return bool
     */
    public function dislikeJob($id){
        $jobId = Job::find($id);
        //we use detach to remove records from favourites table
        $jobId->likes()->detach(auth()->user()->id);
        
        return 'true';
    }
}
