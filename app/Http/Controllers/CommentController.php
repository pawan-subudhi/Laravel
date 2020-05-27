<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Job;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //add comment controller
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $job = Job::find($request->get('job_id'));
        $job->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $job = Job::find($request->get('job_id'));

        $job->comments()->save($reply);

        return back();

    }
}
