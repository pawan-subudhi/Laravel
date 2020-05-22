@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <h2>{{$categoryName->name}}</h2>
        <table class="table">
            <tbody>
                @foreach ( $jobs as $job )
                    <tr>
                        <td>
                            {{-- if you use asset() it targers to the public folder --}}
                            <img src="{{asset('uploads/logo')}}/{{$job->company->logo}}" width="80" alt="avatar image">
                        </td>
                        <td>
                            Position:{{$job->position}}
                            <br>
                            <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;{{$job->type}}
                        </td>
                        <td> 
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            &nbsp;Address:{{$job->address}}
                        </td>
                        <td>
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            &nbsp;Date:{{$job->created_at->diffForHumans()}}
                        </td>
                        <td>
                            <a href="{{route('jobs.show',[$job->id,$job->slug])}}">
                                <button class="btn btn-success btn-sm">Apply</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- gives the links to move to different pages of paginated data--}}
        {{-- if u have searched data using filters then paginate to another page will refresh the url and we will loose the filters so laravel gives append to make our work easier --}}
        {{-- {{$jobs->links()}} --}}
        {{$jobs->appends(request()->except('page'))->links()}}
    </div>
</div>
@endsection
<style>
    .fa{
        color: #4183D7;
    }
</style>
