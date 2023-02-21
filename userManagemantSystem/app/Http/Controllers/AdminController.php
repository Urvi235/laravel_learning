<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\Models\campaign;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use Hash;
use Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function adminDashboard() {
        $users = User::all();

        $campaign_count = count(campaign::all());
        $user_count = count($users);
        $string = '/n/n  rjgrieb /n rjktj';
        // dd(ltrim($string, '/n'));

        return view('admin.dashboard', compact('users', 'campaign_count', 'user_count'));  
      }


      public function adminLogin() {
        if(auth()->guard('admin')->check()) {
          return redirect()->route('adminDashboard');
        }
        return view('admin/login');
      }

      public function validateAdminLogin(Request $request) {
        $validator = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator) {  
            $credentials = $request->only('email', 'password');

            if(Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('adminDashboard');
            }
            else {
                return redirect()->route('adminlogin');
            }
        }
    }      

    public function createUser(Request $request) {
        $messages = [
          'required' => 'The field is required.',
          'first_name.regex' => "Special Characters or numeric values are not allowed",
          'last_name.regex' => "Special Characters or numeric values are not allowed",
          'email' => "must be email",
          'email.unique' => "Please Try with another mail, It's already been taken.",
          'password.regex' => "Your password must contain 8 character, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character."
      ];

        $validator = Validator::make($request->all(), [
          'first_name' => 'required | regex:/^[a-zA-Z]+$/u | regex:/^([^0-9]*)$/',
          'last_name' => 'required | regex:/^[a-zA-Z]+$/u | regex:/^([^0-9]*)$/',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
          'dob' => 'required',
          'gender' => 'required',
          'address' => 'required',
      ], $messages);

        $token = Str::random(60);

        if($validator->fails()) {
          return response()->json(['Status' => 'Fail', 'error'=>$validator->errors()], 401);
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
          $user->save();

          $email = $user->email;
          $password = $request->password;
     
          Mail::to($user->email)->send(new UserCreated($user, $email, $password));

          return response()->json(['status' => 'Done', 'data'=> $user], 200);                
      } 
    }

    public function adminLoginAPI(Request $request) {
      $validator = $request->validate([
          'email' => 'required',
          'password' => 'required',
      ]);

      if($validator) {  
          $credentials = $request->only('email', 'password');
        

          if(Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();
          
            $success =  $user->createToken('MyApp')->accessToken; 

            return response()->json(['status' => 'Success','message' => 'You have successfully logged in', 'data'=> ['token' => $success] ], 200);                
          }
          else {
            return response()->json(['status' => 'Fail', 'data' => ['message'=> 'Please enter valid credentials'] ], 401);            }
      }
    } 

    public function adminLogout() {
      Session::flush();
      Auth::guard('admin')->logout();

      return redirect('admin/login');
    }

    public function getAdminDetails(Request $request) {
      $data = $request->user();
      $user = ['name' => $data->name, 'email' => $data->email ];
      
      return response()->json(['status' => 'success', 'data' => $user], 200);
    }

}


