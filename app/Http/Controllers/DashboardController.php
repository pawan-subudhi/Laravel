<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\DashboardPostRequest;

/**
 * This class is for the CRUD operation of post by admin, toggle job and post status
 * Date: 08/06/2020
 * Author: Pawan
 */
class DashboardController extends Controller
{
        
    /**
     * gets the latest posts 
     *
     * @return view
     */
    public function index(){
        $posts = Post::latest()->paginate(20);
        return view('admin.index',compact('posts'));
    }

    /**
     * returns the create post view
     *
     * @return view
     */
    public function create(){
        return view('admin.create');
    }
    
    /**
     * validate and stores the post data into the database
     *
     * @param  mixed $request
     * @return void
     */
    public function store(DashboardPostRequest $request){

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

    /**
     * returns the edit post view
     *
     * @param  int $id
     * @return void
     */
    public function edit($id){
        $post = Post::find($id);
        return view('admin.edit',compact('post'));
    }
   
    /**
     * updates the post data
     *
     * @param  int $id
     * @param  mixed $request
     * @return void
     */
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

    /**
     * to delete post    
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request){
        $id = $request->get('id');
        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('message','Post deleted successfully');
    }
    
    /**
     * returns the deleted items
     *
     * @return view
     */
    public function trash(){
        //onlyTrashed() is used to get deleted items
        $posts = Post::onlyTrashed()->paginate(20);
        return view('admin.trash',compact('posts'));
    }
    
    /**
     * restores back the deleted post
     *
     * @param  int $id
     * @return void
     */
    public function restore($id){
        //restore() is used to get back the deleted items
        $posts = Post::onlyTrashed()->where('id',$id)->restore();
        return redirect()->back()->with('message','Post restored successfully');
    }
   
    /**
     * toggle method for status 
     *
     * @param  int $id
     * @return void
     */
    public function toggle($id){
        $post = Post::find($id);
        $post->status = !$post->status;
        $post->save();
        return redirect()->back()->with('message','Status updated successfully');
    }

    /**
     * show
     *
     * @param  int $id
     * @return view
     */
    public function show($id){
        $post = Post::find($id);
        return view('admin.read',compact('post'));
    }

    /**
     * getAllJobs for the admin to view
     *
     * @return view
     */
    public function getAllJobs(){
        $jobs = Job::latest()->paginate(30);
        return view('admin.jobs',compact('jobs'));
    }
   
    /**
     * changeJobStatus of jobs
     *
     * @param  int $id
     * @return void
     */
    public function changeJobStatus($id){
        $job = Job::find($id);
        $job->status = !$job->status;
        $job->save();
        return redirect()->back()->with('message','Status updated successfully');
    }
}
