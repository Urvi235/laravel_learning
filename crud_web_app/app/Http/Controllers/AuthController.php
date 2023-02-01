<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Hash; 
use Session;
use Carbon\Carbon;
 
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
            'dob' => 'required '
        ]);

        if($validator){
            $user = new User;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->dob = $request->dob;
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

        if($validator){

            $credentials = $request->only('email','password');
            // dd(Auth::attempt($credentials));
    
            if(Auth::attempt($credentials)){   
                // return ['done'];   
                return redirect()->route('dashboard')->withSuccess('greate you have successfully loggedin...');
            }
            else{
                return redirect()->route('login')->withSuccess('OOPS! Invalid credentials, Try again...');
            }
        }

     
    }

    public function userDetails(){
        // dd(Auth::user());
        $user = Auth::user();
        return view('auth.dashboard', compact('user'));

    }

    

    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }

}
