<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\employee;
use Auth;

class EmployeeDetailController extends Controller
{
    // register employee -----
    public function register(Request $request){
        $validator = Validator::make($request->all(), [ 
            'email'=>'required|email|unique:employees,email',
            'password' => 'required|string |min:8 | regex:/[a-z]/ | regex:/[A-Z]/ |  regex:/[0-9]/ | regex:/[@$!%*#?&]/ ',
            'first_name' => 'required|min:2|alpha |regex:/^\S*$/u ',
            'last_name' => 'required|min:2|alpha |regex:/^\S*$/u ',
            'number' => 'required|numeric|digits:10',
            'dob' => 'required',
            'photo' => 'image | mimes:jpeg,jpg,png | nullable'
        ]);

        if ($validator->fails()){ 
            $errors = $validator->errors()->first(); 
            return ['Status' => "Validator Fails" , 'Error' => $errors];
        }
        else {
            $employee = new employee;
            $employee->email = $request->email;
            $employee->password = Hash::make($request->password);
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->number = $request->number;
            $employee->dob = $request->dob;
            $employee->photo = $request->photo ? $request->photo->store('photosDoc') : null; 
            $employee->save();
            // return $employee;
            $token = $employee->createToken('Myapp')->accessToken;

            return response()->json(["status"=> "Done", "token"->$token]);
        }
    }


    // Get all employee / get by id : 
    public function getemployee($id=null){
        $employee = $id ? employee::find($id) : employee::all();
        return $employee;
    }


    public function login(Request $request){
        // dd($request->email);
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password' => 'required|string |min:8 | regex:/[a-z]/ | regex:/[A-Z]/ |  regex:/[0-9]/ | regex:/[@$!%*#?&]/ ',
        ]);

        if($validator->fails()){
            return ["Status" => "Fail", "Error" => $validator->errors()->first()];
        }

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // dd($data);
        dd(Auth::attempt($data));

        // if($auth){
        //     $employee = Auth::user();
        //     // $token = $employee->createToken('Myapp')->accessToken;
        //     $token = $employee->createToken('Token Name')->accessToken;
        //     // return response()->json(['Token'=> $token]);
        //     return ['token'=> $token];
        // }
        // else{
        //     return ['error'];
        // }
    }
}
