<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Http\Request;
use Hash; 
use Session;

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
                return redirect()->intended('admin/dashbord');
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


    public function adminLogout() {
        Session::flush();
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }


    public function adminDashbord() {
        $users = User::all();

        return view('admin.adminDashboard', compact('users'));
    }


    public function showUserDetail($id) {
        $user = User::find($id);

        $user_posts = $user->posts;
        
        return view('admin.showUserDetails', compact('user', 'user_posts'));
        // if ($user_posts > 0) {
        // }
        // else {
        //     return ['sorry user have no posts '];
        // }
        // dd($user_posts);

    }


    public function deleteUser($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('adminDashbord')->with('success', 'User has been removed successfully.');

    }

}
