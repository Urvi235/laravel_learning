<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserAuthController extends Controller
{
    public function userLogin(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['Status' => 'Fail', 'Error' => $validator->errors()->first()], 401);
        }

        else {
            $credentials = $request->only('email', 'password');
            // dd(Auth::attempt($credentials));
            if(Auth::attempt($credentials)) {
                $user = Auth::user();
                $success = $user->createToken('MyApp')->accessToken;
                return response()->json(['Status' => 'success', 'Token'=> $success], 200);                
            }
            else {
                return response()->json(['Status' => 'Fail', 'error'=>'Unauthorised'], 401);
            }
        }
    }
}
