<?php

namespace App\Http\Controllers;

use App\Models\campaign;
use Illuminate\Http\Request;
use App\Models\User;

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
}
 