<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Session;
use Mail; 
use Hash; 

class UserAuthController extends Controller
{
    public function register() {
        return view('Auth.register');
    }

    public function registerValidate(Request $request) {
        $messages = [
            'required' => 'The field is required.',
            'first_name.regex' => "Special Characters or numeric values are not allowed",
            'last_name.regex' => "Special Characters or numeric values are not allowed",
            'email' => "must be email",
            'email.unique' => "Please Try with another mail, It's already taken.",
            'password.regex' => "Your password must contain 8 character, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character."
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

        if($validator) {
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->remember_token = Str::random(60);
            $user->save();

            // event(new Registered($user));
            Mail::to($user->email)->send(new VerifyEmail($user));

            return redirect('/login');
        } 

        else {
            return [$validator->errors()->first()];
        }
    }



    public function userLogin() {
        // dd(auth()->check());
        if(auth()->check()){
            return redirect()->route('dashboard');
        }
        else {
            return view('Auth.login');
        }
    }

    public function loginValidate(Request $request){ 
        $validator =   $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator){

            $credentials = $request->only('email','password');
            // dd(Auth::attempt($credentials));
    
            if(Auth::attempt($credentials)){   
                // return view('user.dashboard');   
                return redirect()->route('dashboard')->withSuccess('greate you have successfully loggedin...');

            }
            else{
                return redirect()->route('login')->withSuccess('OOPS! Invalid credentials, Try again...');
            }
        }
    }


    public function dashboard() {
        $user = Auth::user();
        
        return view('user.dashboard', compact('user'));
    }


    public function userLogout() {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');

    }
}
