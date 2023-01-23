<?php

namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class employee extends Model
{
    use HasFactory, Uuids, HasApiTokens, Notifiable;

    protected $fillable = ['dob', 'first_name', 'last_name', 'email', 'password', 'number'];
 
    protected $guard = 'employee';
}
 

// public function register(Request $request) 
// { 
//     $validator = Validator::make($request->all(), [ 
//         'name' => 'required', 
//         'email' => 'required|email', 
//         'password' => 'required', 
//         'c_password' => 'required|same:password', 
//     ]);
// if ($validator->fails()) { 
//         return response()->json(['error'=>$validator->errors()], 401);            
//     }
//     $input = $request->all(); 
//     $input['password'] = bcrypt($input['password']); 
//     $user = User::create($input); 
//     $success['token'] =  $user->createToken('MyApp')-> accessToken; 
//     $success['name'] =  $user->name;
//     return response()->json(['success'=>$success], $this-> successStatus); 
// }