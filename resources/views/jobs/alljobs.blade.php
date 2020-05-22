@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        {{-- Since the method is get so all data will be placed in url --}}
        <form action="{{route('alljobs')}}" method="GET">
        <div class="form-inline">
            <div class="form-group">
                <label>Keyword&nbsp;</label>
                <input type="text" name="title" class="form-control">&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <label>Employment type&nbsp;</label>
                <select name="type" class="form-control">
                    <option value="">-select-</option>
                    <option value="fulltime">Full-time</option>
                    <option value="parttime">Part-time</option>
                    <option value="casual">Casual</option>
                </select>&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <label>Category&nbsp;</label>
                <select name="category_id" class="form-control">
                    <option value="">-select-</option>
                    @foreach ( App\Category::all() as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select>&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <label>Address&nbsp;</label>
                <input type="text" name="address" class="form-control">&nbsp;&nbsp;
            </div>
            <div class="form-group">
                <button class="btn btn-outline-success" type="submit">
                    Search
                </button>
            </div>
        </div>
     </form>
        <div class="col-md-12">
        <div class="rounded border jobs-wrap">
            @if(count($jobs)>0)
                @foreach($jobs as $job)

              <a href="{{route('jobs.show',[$job->id,$job->slug])}}" class="job-item d-block d-md-flex align-items-center  border-bottom @if($job->type=='parttime') partime @elseif($job->type=='fulltime')fulltime @else freelance   @endif;">
                <div class="company-logo blank-logo text-center text-md-left pl-3">
                  <img src="{{asset('uploads/logo')}}/{{$job->company->logo}}" alt="Image" class="img-fluid mx-auto">
                </div>
                <div class="job-details h-100">
                  <div class="p-3 align-self-center">
                    <h3>{{$job->position}}</h3>
                    <div class="d-block d-lg-flex">
                      <div class="mr-3"><i class="fa fa-suitcase" aria-hidden="true"></i> {{$job->company->cname}}</div>
                      <div class="mr-3"><i class="fa fa-home" aria-hidden="true"></i> {{str_limit($job->address,20)}}</div>
                      <div><i class="fa fa-inr" aria-hidden="true"></i> {{$job->salary}}</div>
                      <div>&nbsp;<span class="fa fa-clock-o mr-1"></span>{{$job->created_at->diffForHumans()}}</div>
                    </div>
                  </div>
                </div>
                <div class="job-category align-self-center">
                  @if($job->type=='fulltime')
                  <div class="p-3">
                    <span class="text-info p-2 rounded border border-info">{{$job->type}}</span>
                  </div>
                  @elseif($job->type=='parttime')
                  <div class="p-3">
                    <span class="text-danger p-2 rounded border border-danger">{{$job->type}}</span>
                  </div>
                  @else
                   <div class="p-3">
                    <span class="text-warning p-2 rounded border border-warning">{{$job->type}}</span>
                  </div>
                  @endif

                </div>  
              </a>

            @endforeach
            @else
            No jobs found
            @endif


            </div>
        </div>
        {{-- gives the links to move to different pages of paginated data--}}
        {{-- if u have searched data using filters then paginate to another page will refresh the url and we will loose the filters so laravel gives append to make our work easier --}}
        {{-- {{$jobs->links()}} --}}
        {{$jobs->appends(request()->except('page'))->links()}}
    </div>
</div>
@endsection