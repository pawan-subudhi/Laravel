<?php

namespace App\Http\Controllers;

use App\Job;
use App\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        $posts = Post::latest()->paginate(20);
        return view('admin.index',compact('posts'));
    }

    //contains the form
    public function create(){
        return view('admin.create');
    }

    public function store(Request $request){
        //validate data
        $this->validate($request,[
            'title' => 'required|min:3',
            'content' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            //stores inside the storage in public folder insde uploads
            $path = $file->store('uploads','public');
            Post::create([
               'title'  => $title = $request->get('title'),
               'slug'  => str_slug($title),
               'content' => $request->get('content'),
               'image' => $path,
               'status' => $request->get('status'),
            ]);
        }
        return redirect('/dashboard')->with('message','Post created successfully');
    }

    //edit post
    public function edit($id){
        $post = Post::find($id);
        return view('admin.edit',compact('post'));
    }

    //update post
    public function update($id , Request $request){
        $this->validate($request,[
            'title' => 'required|min:3',
            'content' => 'required',
        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            //stores inside the storage in public folder insde uploads
            $path = $file->store('uploads','public');
            Post::where('id',$id)->update([
               'title'  => $title = $request->get('title'),
               'content' => $request->get('content'),
               'image' => $path,
               'status' => $request->get('status'),
            ]);
        } else {
            Post::where('id',$id)->update([
                'title'  => $title = $request->get('title'),
                'content' => $request->get('content'),
                'status' => $request->get('status'),
             ]);
        }
        return redirect()->back()->with('message','Post updated successfully');
    }

    //u can do another function and call it or u can directly write in else see above
    // public function updateAllExceptImage($id , Request $request){
    //     Post::where('id',$id)->update([
    //         'title'  => $title = $request->get('title'),
    //         'content' => $request->get('content'),
    //         'status' => $request->get('status'),
    //      ]);
    // }

    //to delete post
    public function destroy(Request $request){
        $id = $request->get('id');
        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('message','Post deleted successfully');
    }

    public function trash(){
        //onlyTrashed() is used to get deleted items
        $posts = Post::onlyTrashed()->paginate(20);
        return view('admin.trash',compact('posts'));
    }

    public function restore($id){
        //restore() is used to get back the deleted items
        $posts = Post::onlyTrashed()->where('id',$id)->restore();
        return redirect()->back()->with('message','Post restored successfully');
    }

    //toggle method for status
    public function toggle($id){
        $post = Post::find($id);
        $post->status = !$post->status;
        $post->save();
        return redirect()->back()->with('message','Status updated successfully');
    }

    //to read the blog post
    public function show($id){
        $post = Post::find($id);
        return view('admin.read',compact('post'));
    }

    //to show al the jobs for the admin to control over it
    public function getAllJobs(){
        $jobs = Job::latest()->paginate(30);
        return view('admin.jobs',compact('jobs'));
    }

    //change the status of jobs
    public function changeJobStatus($id){
        $job = Job::find($id);
        $job->status = !$job->status;
        $job->save();
        return redirect()->back()->with('message','Status updated successfully');
    }
}
