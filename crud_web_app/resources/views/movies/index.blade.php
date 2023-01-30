@extends('movies.layout')
@section('content')
<div class="wrapperdiv">



@if($messge = Session::get('success'))
<div class="alert alert-success text-center">{{ $messge }}</div> 
@endif

@if($messge = Session::get('comment'))
<div class="alert alert-success text-center">{{ $messge }}</div> 
@endif

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
  @if($movies)
  <tbody>
      @foreach($movies as $movie)
    <tr>
      <td class="align-middle"><img src="{{ asset('uploads/'.$movie->poster ) }} " class="img-thumbnail" /></td>
      <td class="align-middle">{{ $movie->title }}</td>
      <td class="align-middle">{{ $movie->genre }}</td>
      <td class="align-middle">{{ $movie->release_year }}</td>
      <td class="align-middle">
        <form action="{{ route('movies.destroy', $movie->id) }}" method="post">
        <a href="{{ route('movies.show', $movie->id)}} " class="btn btn-info">Show</a>
        <a href="{{ route('movies.edit', $movie->id)}}" class="btn btn-primary">Edit</a>
      
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')">Delete</button>
        </form>



        <h6>Add comment </h6>
        <form method="post" action="{{ route('comment', ['id' => $movie->id]) }} ">
        @csrf
          <div class="form-group">
                            <textarea class="form-control" name="comment" value="{{ $movie->id }}" ></textarea>
                            <input type="hidden" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment" />
                        </div>
          </form>

      </td>

    </tr>
    @endforeach
  </tbody>
  @endif
</table>

<div class="w-5">
  <div class="d-flex"> 
          {!!$movies->links()!!}
  </div>
</div>

</div>
@endsection