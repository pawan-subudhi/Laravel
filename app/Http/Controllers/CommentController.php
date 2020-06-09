<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

/**
 * This class is for storing the comment
 * Date: 08/06/2020
 * Author: Pawan
 */
class CommentController extends Controller
{
        
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request){
    	$request->validate([
            'body'=>'required',
        ]);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
    
        Comment::create($input);
        return back();
    }
}
