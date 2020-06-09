<?php

namespace App\Http\Controllers;

/**
 * This class is for returning the contact view
 * Date: 08/06/2020
 * Author: Pawan
 */
class ContactController extends Controller
{
        
    /**
     * returns the view for contact page
     *
     * @return view
     */
    public function contact(){
        return view('contact.show');
    }
}
