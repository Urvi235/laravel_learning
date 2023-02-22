<?php

namespace App\Http\Controllers;


use App\Models\campaign;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Hash;
use Session;

class AdminController extends Controller
{
    public function adminDashboard() {
        $users = User::all();

        $campaign_count = count(campaign::all());
        $user_count = count($users);
        // $string = '/n/n  rjgrieb /n rjktj';
        // // dd(ltrim($string, '/n'));

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
                return redirect()->route('adminLogin');
            }
        }
    }      


    public function adminLogout() {
      Session::flush();
      Auth::guard('admin')->logout();

      return redirect('admin/login');
    }

    

}


