<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Validator;

class UserApiController extends Controller
{
    public function login(Request $request) {
        $validator = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
  
        if($validator) {  
            $credentials = $request->only('email', 'password');
          
            if(Auth::attempt($credentials)) {
              $user = Auth::user();      
              $success =  $user->createToken('MyApp')->accessToken; 
  
              return response()->json(['status' => 'Success','message' => 'You have successfully logged in', 'data'=> ['token' => $success] ], 200);                
            }
            else {
              return response()->json(['status' => 'Fail', 'message'=> 'Sorry invalide credentials' ], 401);                
            }
        }
    }
    
    public function getUserDetail(Request $request) {
        $data = $request->user();
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'comfirm_new_password' => 'same:new_password'
        ], [
            'new_password.regex' => "Your password must contain 8 character, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.",
            'comfirm_new_password.same' => "Password must match with new password."
        ]); 

        if ($validator->fails()) {
            return response()->json(['Status' => 'Fail', 'error'=>$validator->errors()], 401);
        }

        $check_pass = Hash::check($request->old_password, $request->user()->password);
        // dd($check_pass);

        if($check_pass) {
           User::find($request->user()->id)->update(['password'=> Hash::make($request->new_password)]);

           return response()->json(['status' => 'Success','data' => ['message'=> 'Password has been updated successfully.']], 200);                
        }
        else {
            return response()->json(['status' => 'Fail', 'data' => ['message'=> 'Please enter valid password'] ], 401);                
        }
    }
}

