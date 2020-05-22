@extends('layouts.app')
@section('content')
<div class="container">
    <h1>All Jobs</h1><span style="float:right;"><a href="/dashboard">Back</a></span>
    @if(Session::has('message'))
        <div class="alert alert-success">
        {{Session::get('message')}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    All Jobs
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Created Date</th>
                            <th scope="col">Position</th>
                            <th scope="col">Company</th>
                            <th scope="col">Status</th>
                            <th scope="col">View</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $jobs as $job )
                                <tr>
                                    <th scope="row">{{date('Y-m-d',strtotime($job->created_at))}}</td>
                                    <td>{{$job->position}}</td>
                                    <td>
                                        @if($job->status == 0)
                                        <a href="{{route('job.status',[$job->id])}}" class="badge badge-primary">Draft</a>
                                        @else
                                        <a href="{{route('job.status',[$job->id])}}" class="badge badge-success">Live</a>
                                        @endif
                                      </td>
                                    <td>{{$job->company->cname}}</td>
                                    <td>
                                        <a href="{{route('job.show',[$job->id,$job->slug])}}" target="_blank">
                                            Read
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                    {{$jobs->links()}}
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection