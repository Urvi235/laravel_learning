<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use Hash; 

class AdminController extends Controller
{
    //
    public function adminIndex(){
        return view('admin.adminLogin');
    }

    public function validateAdminLogin(Request $request) {
        $validator = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator) {
            $credentials = $request->only('email', 'password');
            // dd(Auth::guard('admin')->attempt($credentials));
            if(Auth::guard('admin')->attempt($credentials)) {
                return redirect()->route('adminDashbord')->withSuccess('greate you have successfully loggedin...');
                // return view('admin.adminDashboard');
            }
            else {
                return redirect()->route('adminlogin');
            }

        }
    }


    public function adminRegister(){
        return view('admin.registerAdmin');
    }


    public function validateAdminRegister(Request $request){
        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required|min:6',
            'dob' => 'required '
        ]);

        if($validator) {
            $user = new Admin;
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->dob = $request->dob;
            $user->save();

            return view('admin.adminDashboard');

        }
    }


    public function adminDashbord() {
        $users = User::all();

        return view('admin.adminDashboard', compact('users'));
    }

}
