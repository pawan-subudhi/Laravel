@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->profile->avatar))
                <img src="{{asset('avatar/serwman1.jpg')}}" alt="user avatar" width="100" style="width:100%">
            @else 
                <img src="{{asset('uploads/avatar')}}/{{Auth::user()->profile->avatar}}" alt="user avatar" width="100" style="width:100%">
            @endif
            <br>
            <br>
            <div class="card">
                <div class="card-header">
                    Update profile picture   
                </div>
                <div class="card-body">
                    <form action="{{route('avatar')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avatar" class="form-control">
                        <br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
                        @if($errors->has('avatar'))
                        <div class="error" style="color:red;">
                            {{$errors->first('avatar')}}
                        </div>
                    @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Update You Profile
                </div>
                <div class="card-body">
                    <form action="{{route('profile.create')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" 
                                    name="address" 
                                    value="<?php echo Auth::user()->profile->address? Auth::user()->profile->address : old('address') ?>"  class="form-control"
                                    autocomplete="off"
                            >                            
                            {{-- check if any errors then display error using $error variable which laravel provides--}}
                            @if($errors->has('address'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('address')}}
                                </div>
                            @endif

                        </div>
                        
                        <div class="form-group">
                            <label for="phone_number">Phone number</label>
                            <input  type="text" 
                                    name="phone_number" 
                                    value="<?php echo Auth::user()->profile->phone_number? Auth::user()->profile->phone_number : old('phone_number') ?>"  
                                    class="form-control" 
                                    style= "cursor: <?php echo Auth::user()->profile->isVerified ? 'not-allowed':'' ?>;"
                                    autocomplete="off"
                            >

                            @if($errors->has('phone_number'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('phone_number')}}
                                </div>
                            @elseif(Auth::user()->profile->phone_number && !Auth::user()->profile->isVerified )
                                <div class="error" style="color:red;">
                                    Please verify your phone number! Click on update button
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Experience</label>
                            <textarea name="experience" class="form-control" autocomplete="off"><?php echo Auth::user()->profile->experience? Auth::user()->profile->experience : old('experience') ?></textarea>

                            @if($errors->has('experience'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('experience')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Bio</label>
                            <textarea name="bio" class="form-control" autocomplete="off"><?php echo Auth::user()->profile->bio? Auth::user()->profile->bio : old('bio') ?></textarea>

                            @if($errors->has('bio'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('bio')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            @if(Session::has('message') && Session::get('message')!== 'Number need to be verified!' && Session::get('message') !== 'Wrong OTP enetered!')
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            @if(Session::get('message') === 'Number need to be verified!' || Session::get('message') === 'Wrong OTP enetered!' )
                <div class="card" style="
                                        position: fixed;
                                        top: 36%;
                                        left: 25%;
                                        right: 25%;
                                        z-index: 999;"
                >
                    <div class="card-header">Verify Your Phone Number</div>
                    <div class="card-body">
                        @if (Session::get('message') === 'Wrong OTP enetered!')
                            <div class="alert alert-danger" role="alert">
                                {{Session::get('message')}}
                            </div>
                        @endif
                        Please enter the OTP sent to your number: {{Session::get('phone_number')}}
                        <form action="{{route('verify')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="verification_code"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                                <div class="col-md-6">
                                    <input type="hidden" name="phone_number" value="{{Session::get('phone_number')}}">
                                    <input  id="verification_code" 
                                            type="tel"
                                            class="form-control @error('verification_code') is-invalid @enderror"
                                            name="verification_code" value="{{ old('verification_code') }}"
                                            autocomplete="off"
                                            required
                                    >
                                    @error('verification_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Verify Phone Number') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    About You
                </div>
                <div class="card-body">
                    <p>Name:{{Auth::user()->name}}</p>
                    <p>Email:{{Auth::user()->email}}</p>
                    <p>Address:{{Auth::user()->profile->address}}</p>
                    <p>Phone:{{Auth::user()->profile->phone_number}}</p>
                    <p>Gender:{{Auth::user()->profile->gender}}</p>
                    <p>Experience:{{Auth::user()->profile->experience}}</p>
                    <p>Bio:{{Auth::user()->profile->bio}}</p>
                    <p>Member On:{{date('F d Y',strtotime(Auth::user()->created_at))}}</p>
                    @if(!empty(Auth::user()->profile->cover_letter))
                        <p>
                            <a href="{{Storage::url(Auth::user()->profile->cover_letter)}}">
                            Cover Letter
                            </a>
                        </p>
                    @else
                        <p>Please upload your cover letter</p>
                    @endif

                    @if(!empty(Auth::user()->profile->resume))
                        <p>
                            <a href="{{Storage::url(Auth::user()->profile->resume)}}">
                            Resume
                            </a>
                        </p>
                    @else
                        <p>Please upload your resume</p>
                    @endif
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    Update Coverletter
                </div>
                <div class="card-body">
                    <form action="{{route('cover.letter')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="cover_letter" class="form-control">
                        <br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
                        @if($errors->has('cover_letter'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('cover_letter')}}
                                </div>
                            @endif
                    </form>
                </div>
            </div>
            
            <br>

            <div class="card">
                <div class="card-header">
                    Update Resume   
                </div>
                <div class="card-body">
                    <form action="{{route('resume')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="resume" class="form-control">
                        <br>
                        <button class="btn btn-success float-right" type="submit">Update</button>
                        @if($errors->has('resume'))
                                <div class="error" style="color:red;">
                                    {{$errors->first('resume')}}
                                </div>
                            @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
