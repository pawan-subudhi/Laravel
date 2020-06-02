@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(Auth::user()->user_type == 'seeker')
                <h3>{{$title}}</h3>
                <hr>
                @if(count($jobs)>0)
                    @foreach ( $jobs as $job )
                        <div class="card">
                            <div class="card-header">{{$job->title}}</div>
                                <small class="badge badge-primary">
                                    {{$job->position}}
                                </small>
                            <div class="card-body">
                                {{$job->description}}
                            </div>

                            <div class="card-footer">
                                <span>
                                    <a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                                        Read
                                    </a>
                                </span>
                                <span class="float-right">
                                    Last Date : {{$job->last_date}}
                                </span>
                            </div>
                        </div>
                        <br>
                    @endforeach
                @else 
                    <h4 style="text-align: center;color: black;"><strong>No jobs found</strong></h4>   
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
