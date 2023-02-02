@extends('admin.adminLayout')

@section('content')

<div class="wrapperdiv">
<h3>Welcome to the Admin dashboard</h3> 

@if($messge = Session::get('success'))
<div class="alert alert-success text-center">{{ $messge }}</div> 
@endif

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
              <form action="{{ route('deleteUser', $user->id) }}" method="post">
                  <a href="{{ route('showUserDetail', $user->id)}}" class="btn btn-info">Show</a>
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this user?')">Delete</button>
              </form>
            </td>
        </tr>
     
    @endforeach
  </tbody>
@endif
</table>
</div>

@endsection