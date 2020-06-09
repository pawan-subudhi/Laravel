<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EmployerRegisterPostRequest;

/**
 * This class is for registering employer 
 * Date: 08/06/2020
 * Author: Pawan
 */
class EmployerRegisterController extends Controller
{    
    /**
     * takes care of employerRegister by validating data and stores data in database
     *
     * @param  mixed $request
     * @return void
     */
    public function employerRegister(EmployerRegisterPostRequest $request){
    
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
