<?php

namespace App\Http\Controllers;

use App\Profile;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //middleware
    public function __construct(){
        $this->middleware(['seeker','verified']);
    }
    public function index(){
        return view('profile.index');
    }

    public function store(Request $request){
        // validation of data using validate method which takes the request and array of fields which need to be validated
        $this->validate($request,[
            'address'  => 'required',
            'bio' => 'required|min:20',
            'experience' => 'required|min:6',
            'phone_number' => 'required|numeric',
        ]);

        /* Get credentials from .env */
        $token = "";
        $twilio_sid = "";
        $twilio_verify_sid = "";
        
        $twilio = new Client($twilio_sid, $token);
        $twilio->verify->v2->services($twilio_verify_sid)
            ->verifications
            ->create(request('phone_number'), "sms");

        //$request->get('address') and request('address') are both same
        //to get information of current logged in user is using auth 
        $user_id = auth()->user()->id;
        Profile::where('user_id',$user_id)->update([
            'address' => request('address'),
            'experience' => request('experience'),
            'bio' => request('bio'),
            'phone_number' => request('phone_number'),
        ]);
        return redirect()->back()->with(['message'=>'Profile successfully Updated!','phone_number' => request('phone_number')]);
    }

    protected function verify(Request $request)
    {
        $data = $request->validate([
            'verification_code' => ['required', 'numeric'],
            'phone_number' => ['required', 'string'],
        ]);
        /* Get credentials from .env */
        $token = "";
        $twilio_sid = "";
        $twilio_verify_sid = "";
        $twilio = new Client($twilio_sid, $token);
        $verification = $twilio->verify->v2->services($twilio_verify_sid)
            ->verificationChecks
            ->create(request('verification_code'), array('to' => request('phone_number')));
        if ($verification->valid) {
            $user = tap(Profile::where('phone_number', request('phone_number')))->update(['isVerified' => true]);
            /* Authenticate user */
            return redirect()->back()->with('message','Phone number verified');
        }
        return back()->with(['phone_number' => request('phone_number'), 'error' => 'Invalid verification code entered!']);
    }

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
        return redirect()->back()->with('message','Cover letter successfully Updated!');
    }

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
        return redirect()->back()->with('message','Resume successfully Updated!');
    }

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
            return redirect()->back()->with('message','Profile picture successfully Updated!');
        }
    }
}
