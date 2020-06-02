<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthGoogleController extends Controller
{
    //redirect(): redirects our users to the google
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    //Callback(): handle callback from google
    public function callback(){
        try{
            $googleUser = Socialite::driver('google')->user();
            $existUser = User::where('email',$googleUser->email)->first();

            if($existUser){
                Auth::loginUsingId($existUser->id,true);
            } else {
                $user = new User;
                $user->name = $googleUser->name;
                $user->google_id = $googleUser->id;
                $user->user_type = 'seeker';
                $user->email = $googleUser->email;
                $user->email_verified_at = now();
                $user->password = md5(rand(10,1000));
                $user->save();
                Auth::loginUsingId($user->id,true);
                
                Profile::create([
                    'user_id' => $user->id,
                ]);
            }
            return redirect()->to('/user/profile');
        }
        catch(Exception $e){
            return 'error';
        }
    }
}
