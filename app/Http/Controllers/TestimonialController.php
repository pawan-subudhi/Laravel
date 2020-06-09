<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;
use App\Http\Requests\TestimonialPostRequest;

/**
 * This class is for create and read functionlity of testimonies
 * Date: 08/06/2020
 * Author: Pawan
 */
class TestimonialController extends Controller
{    
    /**
     * index return all the testimonies
     *
     * @return view
     */
    public function index(){
        $testimonials = Testimonial::paginate(10);
        return view('testimonial.index',compact('testimonials'));
    }
    
    /**
     * create testimony
     *
     * @return view
     */
    public function create(){
        return view('testimonial.create');
    }
    
    /**
     * store the testimony in the database
     *
     * @param  mixed $request
     * @return void
     */
    public function store(TestimonialPostRequest $validationRules, Request $request){
        
        Testimonial::create([
            'content' => $request->get('content'),
            'name' => $request->get('name'),
            'profession' => $request->get('profession'),
            'video_id' => $request->get('video_id'),
        ]);
        return redirect()->back()->with('message','Testimonial created successfully');
    }
}
