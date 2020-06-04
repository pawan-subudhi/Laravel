<?php

namespace App\Http\Controllers;

use Exception;
use \GuzzleHttp\Client;
use Illuminate\Http\Request;

class ExternalJobController extends Controller
{
    //
    public function getApiData(){
        $client = new Client();
        $jobs = $client->get('https://jobs.github.com/positions.json');
        $jobs = json_decode($jobs->getBody());
        return view('externalJobs.alljobs',compact('jobs'));        
    }

    public function show($id){
        $client = new Client();
        $url = 'https://jobs.github.com/positions/'.$id.'.json';
        $job = $client->get($url);
        $job = json_decode($job->getBody());
        return view('externalJobs.show',compact('job','$job'));
    }
}
