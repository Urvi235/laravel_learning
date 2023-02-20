@extends('campaign.layout')

@section('content')

@if($messge = Session::get('success'))
<div class="alert alert-success text-center">{{ $messge }}</div> 
@endif

<h4 class="align">List of the Campaigns</h4>

<table class="table">
<thead>
    <tr> 
      <th scope="col">Image</th> 
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col"></th>
    </tr>
  </thead>
  @if($campaign)
  <tbody>
      @foreach($campaign as $campaigns)
    <tr>
      <td class="align-middle"><img src="{{ asset('uploads/'.$campaigns->img ) }} " class="img-thumbnail" /></td>
      <td class="align-middle" style="width : 8%" >{{ $campaigns->title }}</td>
      <td class="text">{!!$campaigns->Description!!}</td>
      <td class="align-middle">
        <form action="{{ route('campaign.destroy', $campaigns->id) }}" method="post">

          <a href="{{ route('campaign.show', $campaigns->unique_id)}} "  class="btn btn-info">Show  </a>
          
          @if (Auth::user()->id == $campaigns->user_id)
            <a href="{{ route('campaign.edit', $campaigns->id)}}" class="btn btn-primary">Edit </a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')">Delete</button>
          @endif

        </form>
      </td>
      
    </tr>
    @endforeach
  </tbody>
  @endif
</table>

  <div class="d-flex"> 
          {!! $campaign->links() !!}
  </div>

</div>
@endsection
