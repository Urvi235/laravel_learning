@extends('admin.layout')
@section('content')


<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <span class="navbar-brand" href="#">{{$user->name}}'s All Posts:</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>    
    </div>
</nav>


@if(count($user_posts) > 0)
  <div class="w-5">
    <table class="table">
        <thead>
            <tr> 
            <th scope="col">Poster</th> 
            <th scope="col">Title</th>
            <th scope="col">Genre</th>
            <th scope="col">Release Year</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($user_posts as $post)
            <tr>
                <!-- <div style= "width : 10%"> -->
                <td class="align-middle" style = "width : 10%"><img src="{{ asset('uploads/'.$post->poster ) }} " class="img-thumbnail" /></td>
                <td class="align-middle">{{ $post->title }}</td>
                <td class="align-middle">{{ $post->genre }}</td>
                <td class="align-middle">{{ $post->release_year }}</td>           

            </tr>
            @endforeach
        </tbody>
        
    </table>
  

  @else 
    <h5 style = "text-align: center">no posts yet </h5>
    
    @endif

@endsection