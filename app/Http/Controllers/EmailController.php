<?php

namespace App\Http\Controllers;

use App\Mail\SendJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request){
        $homeUrl = url('/');
        $jobId = $request->get('job_id');
        $jobSlug = $request->get('job_slug');
        //need complete url to open when send
        $jobUrl = $homeUrl.'/jobs/'.$jobId.'/'.$jobSlug;
        //send data 
        $data = array(
            'your_name' => $request->get('your_name'),
            'your_email' => $request->get('your_email'),
            'friend_name' => $request->get('friend_name'),
            'job_url' => $jobUrl,
        );
        $emailTo = $request->get('friend_email');
        try{
            Mail::to($emailTo)->send(new SendJob($data));
            return redirect()->back()->with('message','Job Sent to '.$emailTo);
        } catch(\Exception $e){
            return redirect()->back()->with('err_message','Sorry, Something Went Wrong.Please try later');
        }
    }
}

