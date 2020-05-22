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
                      <th>Image</th>
                      <th>Title</th>
                      <th>Content</th>
                      <th>Status</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $posts as $post )
                      <tr>
                        <td>
                          <img src="{{asset('storage/'.$post->image)}}" width="80">
                        </td>
                        <td>{{$post->title}}</td>
                        <td>{{str_limit($post->title,20)}}</td>
                        <td>
                          @if($post->status == 0)
                            <a href="" class="badge badge-primary">Draft</a>
                          @else
                          <a href="" class="badge badge-success">Live</a>
                          @endif
                        </td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>
                          <a href="{{route('post.restore',[$post->id])}}">
                            <button class="btn btn-primary">Restore</button>
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              {{-- pagination links --}}
              {{$posts->links()}}
              </div>
           </div>
        </div>
    </div>
</div>
@endsection