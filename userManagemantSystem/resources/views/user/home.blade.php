@extends('user.layout')

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
      @foreach($campaign as $campaign)
    <tr>
      <td class="align-middle"><img src="{{ asset('uploads/'.$campaign->img ) }} " class="img-thumbnail" /></td>
      <td class="align-middle" style="width : 8%" >{{ $campaign->title }}</td>
      <td class="text">{{!!$campaign->Description!!}}</td>
      <td class="align-middle">
        <form action="{{ route('campaign.destroy', $campaign->id) }}" method="post">

          <a href="{{ route('campaign.show', $campaign->unique_id)}} "  class="btn btn-info">Show  </a>
          
          @if (Auth::user()->id == $campaign->user_id)
            <a href="{{ route('campaign.edit', $campaign->id)}}" class="btn btn-primary">Edit </a>
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

</div>
@endsection
