@extends('layouts.main')
    @section('content')
<div class="album text-muted">
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
        
        <div class="row" id="app">
            <div class="title" style="margin-top: 20px;">
                <h2>{{$job->title}}</h2> 
            </div>
            <img src="{{asset('hero-job-image.jpg')}}" style="width: 100%;">
            <div class="col-lg-8">
                <div class="p-4 mb-8 bg-white">
                    <!-- icon-book mr-3-->
                    <h3 class="h5 text-black mb-3">
                        <i class="fa fa-book" style="color: blue;">&nbsp;</i>
                        Description
                    </h3>
                    <p><?php echo $job->description ?></p>
                </div>
            </div>


            <div class="col-md-4 p-4 site-section bg-light">
                <h3 class="h5 text-black mb-3 text-center">Short Info</h3>
                <p>Company name: {{$job->company}}</p>
                <p>Address: {{$job->location}}</p>
                <p>Employment Type: {{$job->type}}</p>
                <p>Position: {{$job->title}}</p>
                <p>Posted: {{$job->created_at}}</p>
                <p><a href="{{$job->company_url}}" target="_blank" class="btn btn-warning" style="width: 100%;">Visit Company Page</a></p>
                <p>
                    <a href="#" class="btn btn-success" style="width: 100%;" data-toggle="modal" data-target="#exampleModal1">
                        How to apply
                    </a>
                </p>
    
                <!-- Modal to share job link -->
                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">How to apply for this job</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <?php echo $job->how_to_apply ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

        </div>
        <br>
        <br>
        <br>
    </div>
</div>
<br><br>
@endsection