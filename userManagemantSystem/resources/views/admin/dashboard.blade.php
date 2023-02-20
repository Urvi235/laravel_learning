@extends('admin.layout')

@section('content')

<div class="wrapperdiv">
<div class="float-parent-element">
    <div class="float-child-element">
        <h4 class='red'>Welcome to the dashboard</h4>
    </div>
   
</div>
</div>

<div class="float-parent-element">
    <div class="float-child-element">
    Total Users : {{$user_count}} 
    </div>
    <div class="float-child-element">
    Total campaign : {{$campaign_count}} 
    </div>


</div>

@if($messge = Session::get('error'))
<div class="alert alert-danger text-center">{{ $messge }}</div> 
@endif

<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Gender</th>
      <th scope="col">Birth Date</th>
    </tr>
  </thead>

  @if($users)
  <tbody>

  @foreach ($users as $user)


    <tr>
      <td class="align-middle"></td>
      <td class="align-middle">{{ $user->first_name}} {{$user->last_name}}</td>
      <td class="align-middle">{{ $user->email }}</td>
      <td class="align-middle">{{ $user->gender }}</td>
      <td class="align-middle">{{ $user->dob }}</td>

    </tr>
     
    @endforeach

  </tbody>
  @endif
</table>
</div>

@endsection