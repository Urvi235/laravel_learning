@extends('movies.layout')
@section('content')
<div class="wrapperdiv">
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
  @if($user_posts)
  <tbody>
      @foreach($user_posts as $post)
    <tr>
      <td class="align-middle"><img src="{{ asset('uploads/'.$post->poster ) }} " class="img-thumbnail" /></td>
      <td class="align-middle">{{ $post->title }}</td>
      <td class="align-middle">{{ $post->genre }}</td>
      <td class="align-middle">{{ $post->release_year }}</td>
     

    </tr>
    @endforeach
  </tbody>
  @endif
</table>


@endsection