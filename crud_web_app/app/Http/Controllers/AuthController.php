<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AuthController extends Controller
{

    public function index(){
        return view('auth.login');
    }


    public function register(){
        return view('auth.register');
    }

    public function registerValidate(Request $request){
        $validator =   $request->validate([
            'name'=> 'required',
            'email' => 'required | email',
            'password' => 'required|min:6',
        ]);

        if($validator){
            $user = new User;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->save();
         
            return redirect()->route('movies.index')->withSuccess('greate you have successfully register...');
            
        }
        else {
            return [$validator->errors()->first()];
        }

    }

    public function loginValidate(Request $request){
        $validator =   $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email','password');
        
        if(Auth::attempt($credentials)){         
            return redirect()->route('movies.index')->withSuccess('greate you have successfully loggedin...');
        }
        else{
            return redirect()->route('login')->withSuccess('OOPS! Invalid credentials, Try again...');
        }
     
    }

    public function logout(){
        return view('auth.logout');
    }

}
