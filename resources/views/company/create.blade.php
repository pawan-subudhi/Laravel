@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->company->logo))
                <img src="{{asset('avatar/man.jpg')}}" alt="company logo" width="100" style="width: 100%;">
            @else 
                <img src="{{asset('uploads/logo')}}/{{Auth::user()->company->logo}}" alt="Company logo" width="100" style="width:100%">
            @endif
            <br>
            <br>
            <div class="card">
                <div class="card-header">
                    Update Logo   
                </div>
                <div class="card-body">
                    <form action="{{route('company.logo')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="company_logo" class="form-control @error('company_logo') is-invalid @enderror">
                        @error('company_logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <br>
                        <button class="btn btn-dark float-right" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Update You Company Information
                </div>
                <div class="card-body">
                    <form action="{{route('company.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" name="address" value="{{Auth::user()->company->address}}" class="form-control @error('company_logo') is-invalid @enderror">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>     
                        
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" value="{{Auth::user()->company->phone}}" class="form-control @error('phone') is-invalid @enderror">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>     

                        <div class="form-group">
                            <label for="">Website</label>
                            <input type="text" name="website" value="{{Auth::user()->company->website}}" class="form-control @error('website') is-invalid @enderror">
                            @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>     

                        <div class="form-group">
                            <label for="">Slogan</label>
                            <input type="text" name="slogan" value="{{Auth::user()->company->slogan}}"class="form-control @error('slogan') is-invalid @enderror">
                            @error('slogan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>     

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{Auth::user()->company->description}}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>     
                       
                        <div class="form-group">
                            <button class="btn btn-dark" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    About Your Company
                </div>
                <div class="card-body">
                    <p>Name:{{Auth::user()->company->cname}}</p>
                    <p>Address:{{Auth::user()->company->address}}</p>
                    <p>Phone:{{Auth::user()->company->phone}}</p>
                    <p>Website: 
                        <a href="{{Auth::user()->company->website}}">
                            {{Auth::user()->company->website}}
                        </a>
                    </p>
                    <p>Slogan:{{Auth::user()->company->slogan}}</p>
                    <p>Company Page:<a href="company/{{Auth::user()->company->slug}}">View</a></p>
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    Update Cover Photo
                </div>
                <div class="card-body">
                    <form action="{{route('cover.photo')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="cover_photo" class="form-control @error('cover_photo') is-invalid @enderror">
                        @error('cover_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                        <br>
                        <button class="btn btn-dark float-right" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
