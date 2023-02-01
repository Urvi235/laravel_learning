@extends('auth.layout')

@section('content')

<div class="wrapperdiv">
<h3>Welcome to the Admin dashboard</h3> 

<!-- @if($messge = Session::get('error'))
<div class="alert alert-danger text-center">{{ $messge }}</div> 
@endif -->

<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">DOB</th>
      <th scope="col"></th>
    </tr>
  </thead>

@if($users)
  <tbody>
    @foreach ($users as $user)
    
        <!-- <a class="nav-link" href="{{ route('movies.index') }}">Home</a> -->
        <tr>
            <td class="align-middle"></td>
            <td class="align-middle">{{ $user->name }}</td>
            <td class="align-middle">{{ $user->email }}</td>
            <td class="align-middle">{{ $user->dob }}</td>
            <!-- @method('DELETE') -->
            <td class="align-middle">
    
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this user?')">Delete</button>

            </td>
        </tr>
     
    @endforeach
  </tbody>
@endif
</table>
</div>

@endsection