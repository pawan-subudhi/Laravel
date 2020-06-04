@extends('layouts.main')
<style>
  .form-inline .form-control {
    width: 159px !important;
}
</style>
@section('content')
<div class="container">
    @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
        
    <div class="row">
        <div class="col-md-12 my-4">
        <div class="rounded border jobs-wrap">
            @if(count($jobs)>0)
                @foreach($jobs as $job)

                <a  href="{{route('external-jobs.show',[$job->id])}}" 
                    class="job-item d-block d-md-flex align-items-center border-bottom 
                    @if($job->type=='Part Time') partime 
                    @elseif($job->type=='Full Time')fulltime 
                    @else Freelance   
                    @endif;"
                >
                <div class="company-logo blank-logo text-center text-md-left pl-3">
                  @if(empty($job->company_logo))
                        <img src="{{asset('avatar/man.jpg')}}" alt="Image" class="img-fluid mx-auto">
                    @else 
                        <img src="{{$job->company_logo}}" alt="Image" class="img-fluid mx-auto" >
                    @endif
                </div>
                <div class="job-details h-100">
                  <div class="p-3 align-self-center">
                    <h3>{{$job->title}}</h3>
                    <div class="d-block d-lg-flex">
                      <div class="mr-3"><i class="fa fa-suitcase" aria-hidden="true"></i> {{$job->company}}</div>
                      <div class="mr-3"><i class="fa fa-home" aria-hidden="true"></i> {{str_limit($job->location,20)}}</div>
                      <div>&nbsp;<span class="fa fa-clock-o mr-1"></span>{{$job->created_at}}</div>
                    </div>
                  </div>
                </div>
                <div class="job-category align-self-center">
                  @if($job->type=='Full Time')
                  <div class="p-3">
                    <span class="text-info p-2 rounded border border-info">{{$job->type}}</span>
                  </div>
                  @elseif($job->type=='Part Time')
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
              <h4 style="text-align: center;color: black;"><strong>No jobs found</strong></h4>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection