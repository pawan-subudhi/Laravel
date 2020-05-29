@extends('layouts.main')
@section('content')
   <div class="album text-muted">
     <div class="container">
       <div class="row">
         <h1>Seeker Registration</h1>   
         

    

    <div class="site-section bg-light">
      <div class="container">
          @if(Session::has('message'))
                <div class="alert alert-success">
                  {{Session::get('message')}}
              </div>
          @endif
        <div class="row">
          <div class="col-md-12 col-lg-8 mb-5">
          
            <form method="POST" action="{{ route('register') }}" class="p-5 bg-white">
                        @csrf

                        <input type="hidden" value="seeker" name="user_type">
                        <div class="form-group row">
                        {{-- Name field --}}
                            <div class="col-md-12">Name</div>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Email field --}}
                        <div class="form-group row">
                    
                            <div class="col-md-12">Email</div>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- DOB field --}}
                        <div class="form-group row">
                    
                            <div class="col-md-12">Date Of Birth</div>

                            <div class="col-md-12">
                                <input autocomplete="off" type="text" id="datepicker" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required>

                                @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password field --}}
                        <div class="form-group row">
                            <div class="col-md-12">Password</div>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--Confirm Password field --}}
                        <div class="form-group row">
                            <div class="col-md-12">Confirm Password</div>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- Gender field --}}
                        <div class="form-group row">
                            <div class="col-md-12">Gender</div>

                            <div class="col-md-12">
                                <input type="radio" name="gender" value="male" required>Male
                                <input type="radio" name="gender" value="female">Female
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


            {{-- Register Button --}}
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Register as Seeker" class="btn btn-primary  py-2 px-5">
                </div>
              </div>

  
            </form>
          </div>

          <div class="col-lg-4">
            
            
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">More Info</h3>
              <p>Once you create an account a verification link will be sent to your email.</p>
              <p><a href="#" class="btn btn-primary  py-2 px-4">Learn More</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>



     </div>
   </div>
@endsection
