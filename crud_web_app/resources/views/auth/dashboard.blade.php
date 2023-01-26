@extends('auth.layout')

@section('content')

<div class="wrapperdiv">
<h3>Welcome to the user dashboard</h3> 

@if($messge = Session::get('error'))
<div class="alert alert-danger text-center">{{ $messge }}</div> 
@endif

<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">name</th>
      <th scope="col">email</th>
    </tr>
  </thead>

  <tbody>

        <a class="nav-link" href="{{ route('movies.index') }}">Home</a>

    <tr>
      <td class="align-middle"></td>
      <td class="align-middle">{{ $user->name }}</td>
      <td class="align-middle">{{ $user->email }}</td>

    </tr>
     

  </tbody>
</table>
</div>

@endsection