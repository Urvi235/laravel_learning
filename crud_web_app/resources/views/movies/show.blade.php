@extends('movies.layout')
@section('content')
<div class="wrapperdiv">
    @if($movie)
    <div class="row pb-5 " >
        <div class="col-4"></div>
        <div class="col-4">
        <div class="card" style="width: 20rem;">
            <img src="{{ asset('uploads/'.$movie->poster ) }}" class="card-img-top">
            <div class="card-body">
            <h5 class="card-title">{{ $movie->title }}</h5>
            <p class="card-text" >{{ $movie->genre }} | {{ $movie->release_year }} 
            <p class="card-text">Added By: {{$added_by}} </p> 
            </p>
   
            </div>
            </div> 
        </div>

        
        
        <h5>Comments</h5><br>
        @if($comment_id)
            <tbody>
            @foreach($comment_id as $comment_id)
                <tr>
                    <td >{{$comment_id->comment}} :- {{$comment_id['user']->name}}</td><br>
                </tr>
            @endforeach
            </tbody>
        @endif


    </div> 
    @endif
    <div class="text-right" style="width : 90%">

    <a href="{{ route('userAllPost', ['id' => $user_id]) }} ">Watch all posts by {{$added_by}}  </a></div>

 
                              
</div>
@endsection 