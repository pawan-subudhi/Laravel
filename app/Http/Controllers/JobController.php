<?php

namespace App\Http\Controllers;

use App\Job;
use App\Post;
use App\Company;
use App\Category;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\JobPostRequest;//this contains the validation rules for the job form if we follow this method of validation the pass jobpostrequest as a parameter inside store method

/**
 * This class is for CRUD operation related to jobs, handles job recommendation functionality and checks the user is applied for a job or not
 * Date: 08/06/2020
 * Author: Pawan
 */
class JobController extends Controller
{
    /**
     * __construct it contains middleware for protecting the routes
     *
     * @return void
     */
    public function __construct(){
        $this->middleware(['employer','verified'],['except'=>array('index','show','apply','allJobs','searchJobs')]);
    }

    /**
     * lists all job in the home page i.e welcome page    
     *
     * @return view
     */
    public function index(){
        //posts by admin which need to be shown in the home page in blog post section
        $posts = Post::where('status',1)->get();

        //testimonials by admin which need to be shown in the home page in testimonials post section
        $testimonial = Testimonial::orderBy('id','DESC')->first();

        $jobs = Job::latest()->limit(10)->where('status',1)->get();//fetches latest 10 records

        $categories = Category::with('jobs')->get();//to display categories  and count of jobs in each

        $companies = Company::get()->random(12);
        return view('welcome',compact('jobs','companies','categories','posts','testimonial'));
    }

    /**
     * show responsible once u click a job then it will show all the details regarding jobs 
     *
     * @param  int $id
     * @param  mixed $job
     * @return view
     */
    public function show($id,Job $job){
        $jobRecommendations = $this->jobRecommendations($job);
        //we will be showing jobs using slug not by id so need to create a getRouteKeyName()
        //you can do alternate to writing Job class inside the paramater is inside the function $job =Job::find($id)
        return view('jobs.show',compact('job','jobRecommendations'));
    }

    /**
     * jobRecommendations
     *
     * @param  mixed $job
     * @return array
     */
    public function jobRecommendations($job){
        $data = [];
        //job recommedation based on category
        $jobBasedOnCategories = Job::latest()
                                ->where('category_id',$job->category_id)->whereDate('last_date','>',date('Y-m-d'))
                                ->where('id','!=',$job->id)
                                ->where('status',1)
                                ->limit(6)
                                ->get();
        array_push($data,$jobBasedOnCategories);
        //job recommedation based on company category id
        $jobBasedOnCompany = Job::latest()
                                ->where('company_id',$job->company_id)->whereDate('last_date','>',date('Y-m-d'))
                                ->where('id','!=',$job->id)
                                ->where('status',1)
                                ->limit(6)
                                ->get();
        array_push($data,$jobBasedOnCompany);
        //job recommendation based on position
        $jobBasedOnPosition = Job::latest()
                                ->where('position','LIKE','%'.$job->position.'%')
                                ->whereDate('last_date','>',date('Y-m-d'))
                                ->where('id','!=',$job->id)
                                ->where('status',1)
                                ->limit(6)
                                ->get();
        array_push($data,$jobBasedOnPosition);
        $collection = collect($data);
        $unique = $collection->unique("id");
        $jobRecommendations = $unique->values()->first();
        return $jobRecommendations;
    }
    
    /**
     * myjob
     *
     * @return view
     */
    public function myjob(){
        $jobs = Job::where('user_id',auth()->user()->id)->get();
        return view('jobs.myjob',compact('jobs'));
    }
    
    /**
     * edit job 
     *
     * @param  int $id
     * @return view
     */
    public function edit($id){
        $job = Job::findOrFail($id);
        return view('jobs.edit',compact('job'));
    }
    
    /**
     * update job
     *
     * @param  mixed $request
     * @param  int $id
     * @return void
     */
    public function update(Request $request,$id){
        $job = Job::findOrFail($id);
        $job->update($request->all());
        return redirect()->back()->with('message','Job successfully updated');
    }
        
    /**
     * create job 
     *
     * @return view
     */
    public function create(){
        return view('jobs.create');
    }

    /**
     * store job details in database
     *
     * @param  mixed $request
     * @return void
     */
    public function store(JobPostRequest $request){
        $user_id = auth()->user()->id;
        $company = Company::where('user_id',$user_id)->first();
        $company_id = $company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title' => request('title'),
            'slug' => str_slug(request('title')),
            'description' => request('description'),
            'roles' => request('roles'),
            'category_id' => request('category'),
            'position' => request('position'),
            'address' => request('address'),
            'type' => request('type'), 
            'status' => request('status'), 
            'last_date' => request('last_date'), 
            'number_of_vacancy' => request('number_of_vacancy'),
            'gender' => request('gender'),
            'experience' => request('experience'),
            'salary' => request('salary'),
        ]);
        return redirect()->back()->with('message','Job posted successfully!');
    }
    
    /**
     * apply job
     *
     * @param  mixed $request
     * @param  int $id
     * @return bool
     */
    public function apply(Request $request,$id){
        $jobId = Job::find($id);
        //attach the logged in user id
        $jobId->users()->attach(Auth::user()->id);
    
        return 'true';
    }
    
    /**
     * it checks wether the job has users or not
     *
     * @return view
     */
    public function applicant(){
        $applicants = Job::has('users')->where('user_id',auth()->user()->id)->get();
        return view('jobs.applicants',compact('applicants'));
    }
    
    /**
     * allJobs handles the search job functionilty
     *
     * @param  mixed $request
     * @return view
     */
    public function allJobs(Request $request){
        
        //front search
        $search = $request->get('search');
        if($search){
            $jobs = Job::where('position','LIKE','%'.$search.'%')
                        ->orWhere('title','LIKE','%'.$search.'%')
                        ->orWhere('type','LIKE','%'.$search.'%')
                        ->paginate(10);
            return view('jobs.alljobs',compact('jobs'));
        }

        $keyword = $request->get('title');
        $type = $request->get('type');
        $category = $request->get('category_id');
        $address = $request->get('address');
        //if the user has clicked the search button then perform this search
        if($keyword || $type || $category || $address){
            $jobs = Job::where('title','LIKE','%'.$keyword.'%')
                       ->orWhere('type',$type)
                       ->orWhere('category_id',$category)
                       ->orWhere('address','LIKE','%'.$address.'%')
                       ->paginate(10);
            return view('jobs.alljobs',compact('jobs'));
         } else{
                //paginate and display
                $jobs = Job::latest()->paginate(10);
                return view('jobs.alljobs',compact('jobs'));
        }
    }
}
 