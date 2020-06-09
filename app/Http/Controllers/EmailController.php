<?php

namespace App\Http\Controllers;

use App\Mail\SendJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

/**
 * This class is for sending a job mail 
 * Date: 08/06/2020
 * Author: Pawan
 */
class EmailController extends Controller
{    
    /**
     * send mail
     *
     * @param  mixed $request
     * @return void
     */
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
            return redirect()->back()->with('message',Config::get('constants.email.send_success').$emailTo);
        } catch(\Exception $e){
            return redirect()->back()->with('err_message',Config::get('constants.email.send_failure'));
        }
    }
}

