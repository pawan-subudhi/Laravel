@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                            @foreach ( $jobs as $job )
                                <tr>
                                    <td width="20%">
                                        @if(empty(Auth::user()->company->logo))
                                            <img src="{{asset('avatar/man.jpg')}}" alt="company logo" width="100">
                                        @else 
                                            <img src="{{asset('uploads/logo')}}/{{Auth::user()->company->logo}}" alt="Company logo" width="100">
                                        @endif
                                    </td>
                                    <td width="20%">
                                        Position:{{$job->position}}
                                        <br>
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;{{$job->type}}
                                    </td>
                                    <td width="20%"> 
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        &nbsp;Address:<br>
                                        {{$job->address}}
                                    </td>
                                    <td width="20%">
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                        &nbsp;Date:<br>
                                        {{$job->created_at->diffForHumans()}}
                                    </td>
                                    <td width="20%">
                                        <a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                                            <button class="btn btn-success p-2">Read</button>
                                        </a>
                                        <a href="{{route('job.edit',[$job->id])}}">
                                            <button class="btn btn-dark p-2">Edit</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
