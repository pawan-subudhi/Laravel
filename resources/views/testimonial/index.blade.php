@extends('layouts.app')
@section('content')
<div class="container">
  @if(Session::has('message'))
    <div class="alert alert-success">
      {{Session::get('message')}}
    </div>
  @endif
    <div class="row">
        <div class="col-md-3">
            @include('admin.left-menu')
        </div>
        <div class="col-md-9">
           <div class="card">
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Content</th>
                      <th>Name</th>
                      <th>Profession</th>
                      <th>Vimeo Video Id</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $testimonials as $testimonial )
                      <tr>
                        <td>{{$testimonial->content}}</td>
                        <td>{{$testimonial->name}}</td>
                        <td>{{$testimonial->profession}}</td>
                        <td>{{$testimonial->video_id}}</td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              {{-- pagination links --}}
              {{$testimonials->links()}}
              </div>
           </div>
        </div>
    </div>
</div>
@endsection