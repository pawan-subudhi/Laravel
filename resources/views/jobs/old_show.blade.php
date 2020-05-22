@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            <div class="card">
            <div class="card-header">{{$job->title}}</div>

                <div class="card-body">
                   <p>
                        <h3>Description</h3>
                        {{$job->description}}
                    </p>
                   <p>
                       <h3>Duties</h3>
                       {{$job->roles}}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Short Info</div>

                <div class="card-body">
                    {{-- relationships is defined as a result we are able to accesss the cname from using job model --}}
                    <p>Company: <a href="{{route('company.index',[$job->company->id,$job->company->slug])}}">
                                     {{$job->company->cname}} 
                                </a>
                    </p>
                    <p>Address:{{$job->address}}</p>
                    <p>Employment Type:{{$job->type}}</p>
                    <p>Position:{{$job->position}}</p>
                    <p>Posted:{{$job->created_at->diffForHumans()}}</p>
                    <p>Last date to apply:{{date('F d, Y',strtotime($job->last_date))}}</p>
                </div>
            </div>
            <br>
            {{-- Auth::check check the user is logged in or not  --}}
            @if(Auth::check() && Auth::user()->user_type=='seeker')
                @if(!$job->checkApplication())
                    {{-- Comeneted because this part we wrote in apply component vue file --}}
                    {{-- <form action="{{route('apply',[$job->id])}}" method="POSt">
                        @csrf
                        <button class="btn btn-success btn-block mt-3" type="submit">Apply</button>
                    </form> --}}
                    {{-- because we commented above so we need to write these lines to apply the component written in apply component vue file --}}
                    {{-- pass argument of job id --}}
                    <apply-component :jobid={{$job->id}}></apply-component>
                @endif
                    <favourite-component :jobid={{$job->id}} :favourited={{$job->checkSaved()?'true':'false'}}></favourite-component>
            @endif
        </div>
    </div>
</div>
@endsection
