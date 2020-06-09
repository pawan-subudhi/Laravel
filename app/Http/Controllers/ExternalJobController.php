<?php

namespace App\Http\Controllers;

use Exception;
use \GuzzleHttp\Client;

/**
 * This class is for fetching all job details and single job detail from API
 * Date: 08/06/2020
 * Author: Pawan
 */
class ExternalJobController extends Controller
{    
    /**
     * getApiData gets data of all jobs
     *
     * @return view
     */
    public function getApiData(){
        $client = new Client();
        $jobs = $client->get('https://jobs.github.com/positions.json');
        $jobs = json_decode($jobs->getBody());
        return view('externalJobs.alljobs',compact('jobs'));        
    }
    
    /**
     * show gets the data of particular job
     *
     * @param  mixed $id
     * @return view
     */
    public function show($id){
        $client = new Client();
        $url = 'https://jobs.github.com/positions/'.$id.'.json';
        $job = $client->get($url);
        $job = json_decode($job->getBody());
        return view('externalJobs.show',compact('job','$job'));
    }
}
