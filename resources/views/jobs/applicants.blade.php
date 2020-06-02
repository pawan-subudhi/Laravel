@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Applicants</h3>
    <div class="row justify-content-center">
        <div class="col-md-12">       
            @foreach($applicants as $applicant)
                <div class="card">
                    <div class="card-header">
                        <a href="{{route('jobs.show',[$applicant->id,$applicant->slug])}}">
                            <strong>{{$applicant->title}}</strong>
                        </a>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                                <thead>
                                    <tr>
                                      <th><strong>Name</strong></th>
                                      <th><strong>Email</strong></th>
                                      <th><strong>Address</strong></th>
                                      <th><strong>Gender</strong></th>
                                      <th><strong>Bio</strong></th>
                                      <th><strong>Experience</strong></th>
                                      <th><strong>Resume</strong></th>
                                      <th><strong>Cover Letter</strong></th>
                                      
                                    </tr>
                                  </thead>
                                @foreach($applicant->users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->profile->address}}</td>
                                        <td>{{$user->profile->gender}}</td>
                                        <td>{{$user->profile->bio}}</td>
                                        <td>{{$user->profile->experience}}</td>
                                        <td><a href="{{Storage::url($user->profile->resume)}}">Resume</a></td>
                                        <td><a href="{{Storage::url($user->profile->cover_letter)}}">Cover Letter</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
                <br>
            @endforeach
        </div>
    </div>
</div>
@endsection