@extends('Auth.layout')

@section('content')

<main class="login-form">
  <div class="cotainer">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Register</div>
                  <div class="card-body">

                      
                    <form action="{{ route('registerValidate') }}" method="POST">
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">First-Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="first_name" class="form-control" name="first_name" >
                                  @if ($errors->has('first_name'))
                                      <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">Last-Name</label>
                              <div class="col-md-6">
                                  <input type="text" id="last_name" class="form-control" name="last_name" >
                                  @if ($errors->has('last_name'))
                                      <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                              <div class="col-md-6">
                                  <input type="text" id="email_address" class="form-control" name="email" >
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                              </div>
                          </div>
  
                          <div class="form-group row">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input type="password" id="password" class="form-control" name="password" >
                                  @if ($errors->has('password'))
                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                  @endif
                              </div> 
                          </div>

                          <div class="form-group row">
                              <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                              <div class="col-md-6">
                                  <input type="address" id="address" class="form-control" name="address" >
                                  @if ($errors->has('address'))
                                      <span class="text-danger">{{ $errors->first('address') }}</span>
                                  @endif
                              </div> 
                          </div>

                          <div class="form-group row">
                              <label for="dob" class="col-md-4 col-form-label text-md-right">Gender</label>
                              <div class="col-md-6">

                                  <div class="d-flex align-items-center"><input id="female" type="radio" class="form-control w-25" name="gender" value="Female"><span> Female</span>
                                   <input id="male" type="radio" class="form-control w-25" name="gender" value="Male"><span> Male</span></div>

                                  @if ($errors->has('gender'))
                                      <span class="text-danger">{{ $errors->first('gender') }}</span>
                                  @endif
                              </div>
                              
                          </div>

                          <div class="form-group row">
                              <label for="dob" class="col-md-4 col-form-label text-md-right">DOB</label>
                              <div class="col-md-6">
                                  <input type="date" id="dob" class="form-control" name="dob" >
                                  @if ($errors->has('dob'))
                                      <span class="text-danger">{{ $errors->first('dob') }}</span>
                                  @endif
                              </div>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker4').datetimepicker();
                                    });
                                </script>
                          </div>
  
                          
  
                          <div class="col-md-6 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  Register
                              </button>
                          </div>
                      </form>
                        
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
<!-- @endsection -->