<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use Hash;
use Mail;
use Illuminate\Support\Facades\Auth;


class AdminApiController extends Controller
{
    public function createUser(Request $request) {
        $messages = [
          'required' => 'The field is required.',
          'first_name.regex' => "Special Characters or numeric values are not allowed",
          'last_name.regex' => "Special Characters or numeric values are not allowed",
          'email' => "must be email",
          'email.unique' => "Please Try with another mail, It's already been taken.",
      ];

        $validator = Validator::make($request->all(), [
          'first_name' => 'required | regex:/^[a-zA-Z]+$/u | regex:/^([^0-9]*)$/',
          'last_name' => 'required | regex:/^[a-zA-Z]+$/u | regex:/^([^0-9]*)$/',
          'email' => 'required|email|unique:users',
          'dob' => 'required',
          'gender' => 'required',
          'address' => 'required',
      ], $messages);

        $token = Str::random(60);

        if($validator->fails()) {
          return $this->sendFailResponse('please enter valid Informations.', $validator->errors());
        }
        else{
          $user = new User;
          $user->first_name = $request->first_name;
          $user->last_name = $request->last_name;
          $user->email = $request->email;
          $user->password = Hash::make('User@1234');
          $user->dob = $request->dob;
          $user->gender = $request->gender;
          $user->address = $request->address;
          $user->remember_token = $token;
          $user->is_email_verified = 1;
          $user->save();

          $email = $user->email;
          $password = $request->password;
     
          Mail::to($user->email)->send(new UserCreated($user, $email, $password));

          return $this->sendSuccessResponse('User is created successfully.', $user );             
      } 
    }


    public function adminLoginAPI(Request $request) {
      $validator = Validator::make($request->all(), [
        'email' => 'required',
        'password' => 'required',
      ]);
      
      if($validator->fails()) {
        return $this->sendFailResponse('please enter valid credentials.', $validator->errors());
      }
      
      try {
        $credentials = $request->only('email', 'password');
        
        if(Auth::guard('admin')->attempt($credentials)) {
          $user = Auth::guard('admin')->user();

          if($user->tokens->first()) {
            $user->tokens->first()->revoke();
            $success['token'] =  $user->createToken('MyApp')->accessToken; 

            return $this->sendSuccessResponse('You have successfully logged in',['token' => $success['token']]);
          }
          
          else {
            $success['token'] =  $user->createToken('MyApp')->accessToken; 
            return $this->sendSuccessResponse('You have successfully logged in',['token' => $success['token']]);
          }
        }

        else {
            return $this->sendFailResponse('please enter valid credentials.');
        }
      }

      catch(\Exception $exception) {
          return $this->sendFailResponse('Sorry invalide credentials');
      }    
    } 

    public function getAdminDetails(Request $request) {
      $data = $request->user();
      $user = ['name' => $data->name, 'email' => $data->email ];
      
      return $this->sendSuccessResponse('Successfully Retrive admin details', $user);

    }


}
