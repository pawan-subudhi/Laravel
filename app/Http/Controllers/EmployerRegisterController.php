<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployerRegisterController extends Controller
{
    public function employerRegister(Request $request){
        //verify data
        $this->validate($request,[
            'cname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',//confirmed means both the password and confirm password field must be same
        ]);
        $user = User::create([
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'user_type' => request('user_type'),
        ]);
        
        // request is used to retrieve the value from the form
        Company::create([
            'user_id' => $user->id,
            'cname' => request('cname'),
            // we use str_slug to convert anything to slug in laravel
            'slug' => str_slug(request('cname')),
        ]);
        $user->sendEmailVerificationNotification();//laravel uses this to send the email verification notification we are using this here because this php file is custom i.e. build by us so we have to use here
        
        // redirect to login page to login 
        return redirect()->back()->with('message','Please verify your email by clicking the link sent to your email address');
    }
}
