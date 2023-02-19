<?php

namespace App\Http\Controllers;

use App\Models\campaign;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;
use Hash;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function adminDashboard() {
        $users = User::all();

        $campaign_count = count(campaign::all());
        $user_count = count($users);

        return view('admin.dashboard', compact('users', 'campaign_count', 'user_count'));  
      }

      public function campaign() {
        $campaign_count = campaign::all();
        dd($campaign_count);
      }

      public function adminLogin() {
        return view('admin/login');
      }

    //   public function validateAdminLogin(Request $request) {
    //     $validator = $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);

    //     if($validator) {  
    //         $credentials = $request->only('email');
    //         // dd($credentials);
    //         dd(Auth::guard('admin')->attempt(array('email'=> $request->email)));
    //         if(Auth::guard('admin')->attempt($credentials)) {
    //             return redirect()->route('adminDashbord');
    //             // return view('admin.adminDashboard');
    //         }
    //         else {
    //             return redirect()->route('adminlogin');
    //         }

    //     }
    // }      

    public function createUser(Request $request) {
        $messages = [
          'required' => 'The field is required.',
          'first_name.regex' => "Special Characters or numeric values are not allowed",
          'last_name.regex' => "Special Characters or numeric values are not allowed",
          'email' => "must be email",
          'email.unique' => "Please Try with another mail, It's already taken.",
          // 'password.regex' => "Your password must contain 8 character, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character."
      ];
      $validator = $request->validate([
          'first_name' => 'required | regex:/^[a-zA-Z]+$/u | regex:/^([^0-9]*)$/',
          'last_name' => 'required | regex:/^[a-zA-Z]+$/u | regex:/^([^0-9]*)$/',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
          'dob' => 'required',
          'gender' => 'required',
          'address' => 'required',
      ],$messages);

      $token = Str::random(60);

      if($validator) {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->remember_token = $token;
        $user->save();

        Mail::to($user->email)->send(new VerifyEmail($user));

        return response()->json(['Status' => 'success', 'User'=> $user], 200);                
    } 

    else {
        $error = $validator->errors()->first();
        return response()->json(['Status' => 'Fail', 'error'=>$error], 401);

    }
    }
}
 