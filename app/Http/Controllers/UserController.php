<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\SeekerPostRequest;

/**
 * This class is for creating and viewing user details
 * Date: 08/06/2020
 * Author: Pawan
 */
class UserController extends Controller
{    
    /**
     * __construct handles the middleware
     *
     * @return void
     */
    public function __construct(){
        $this->middleware(['seeker','verified']);
    }
        
    /**
     * handles the user profile view
     *
     * @return view
     */
    public function index(){
        return view('profile.index');
    }
    
    /**
     * stores the user details
     *
     * @param  mixed $request
     * @return void
     */
    public function store(SeekerPostRequest $request){

        $user_id = auth()->user()->id;
        $profile = Profile::where('user_id',$user_id)->first();
        if($profile->phone_number == request('phone_number') && $profile->isVerified){
            Profile::where('user_id',$user_id)->update([
                'address' => request('address'),
                'experience' => request('experience'),
                'bio' => request('bio'),
            ]);
            return redirect()->back()->with('message',Config::get('constants.seeker.seeker_info'));
        } else {
            $profile = Profile::where('phone_number',request('phone_number'))->first();
            if(!$profile || $profile->user_id == $user_id){
                /* Get credentials from .env */
                $token = env('TWILIO_TOKEN');
                $twilio_sid = env('TWILIO_SID');
                $twilio_verify_sid = env('TWILIO_VERIFY_SID');
                
                $twilio = new Client($twilio_sid, $token);
                $twilio->verify->v2->services($twilio_verify_sid)
                    ->verifications
                    ->create(request('phone_number'), "sms");

                Profile::where('user_id',$user_id)->update([
                    'address' => request('address'),
                    'experience' => request('experience'),
                    'bio' => request('bio'),
                    'phone_number' => request('phone_number'),
                ]);
                return redirect()->back()->with(['message'=>Config::get('constants.seeker.number_verified'),'phone_number' => request('phone_number')]);
            } else {
                return redirect()->back()->with('message',Config::get('constants.seeker.number_taken'));
            }   
        }
    }
    
    /**
     * verifies the user phone number
     *
     * @param  mixed $request
     * @return void
     */
    protected function verify(Request $request)
    {
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);
        /* Get credentials from .env */
        $token = env('TWILIO_TOKEN');
        $twilio_sid = env('TWILIO_SID');
        $twilio_verify_sid = env('TWILIO_VERIFY_SID');
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(request('verification_code'), array('to' => request('phone_number')));
        if ($verification->valid) {
            tap(Profile::where('phone_number', request('phone_number')))->update(['isVerified' => true]);
            /* Authenticate user */
            return redirect()->back()->with('message',Config::get('constants.seeker.complete_seeker_update'));
        } else {
            return redirect()->back()->with('message',Config::get('constants.seeker.wrong_otp'));
        }
    }
    
    /**
     * validate and stores the coverletter
     *
     * @param  mixed $request
     * @return void
     */
    public function coverletter(Request $request){
        // validation
        $this->validate($request,[
            'cover_letter' => 'required|mimes:pdf,doc,docx|max:2000',
        ]);
        $user_id = auth()->user()->id;
        // store is used to store a file inside storage/app/public 
        $cover = $request->file('cover_letter')->store('public/files');
        Profile::where('user_id',$user_id)->update([
            'cover_letter' => $cover,
        ]);
        return redirect()->back()->with('message',Config::get('constants.seeker.cover_letter'));
    }
    
    /**
     * validate and stores the resume
     *
     * @param  mixed $request
     * @return void
     */
    public function resume(Request $request){
        // validation
        $this->validate($request,[
            'resume' => 'required|mimes:pdf,doc,docx|max:2000',
        ]);
        $user_id = auth()->user()->id;
        // store is used to store a file inside storage/app/public 
        $resume = $request->file('resume')->store('public/files');
        Profile::where('user_id',$user_id)->update([
            'resume' => $resume,
        ]);
        return redirect()->back()->with('message',Config::get('constants.seeker.resume'));
    }
    
    /**
     * validate and stores the avatar
     *
     * @param  mixed $request
     * @return void
     */
    public function avatar(Request $request){
        // validation
        $this->validate($request,[
            'avatar' => 'required|mimes:png,jpg,jpeg|max:2000',
        ]);
        $user_id = auth()->user()->id;
        if($request->hasfile('avatar')){
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('uploads/avatar',$filename);
            Profile::where('user_id',$user_id)->update([
                'avatar' => $filename,
            ]);
            return redirect()->back()->with('message',Config::get('constants.seeker.profile_pic'));
        }
    }
}
