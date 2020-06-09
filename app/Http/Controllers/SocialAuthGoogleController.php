<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

/**
 * This class is for handling the redirect and callback function to google oauth API
 * Date: 08/06/2020
 * Author: Pawan
 */
class SocialAuthGoogleController extends Controller
{
    /**
     * redirects our users to the google oauth api
     *
     * @return void
     */
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    /**
     * handles callback from google and the user registeration 
     *
     * @return void
     */
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
