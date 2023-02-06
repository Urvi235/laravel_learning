<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Movie;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class MovieAPIController extends Controller
{
    public function getMovies($id = null) {
        $movies = $id ? Movie::find($id) : Movie::all();
        return response()->json(["Status" => "Success", "movies" => $movies], 200);
    }


    public function create(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'title' => 'required',
            'genre' => 'required',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json(['Status' => 'Error', 'Error' => $validator->errors()->first()], 403);
        }

        $imageName = '';
        if ($request -> poster) {
            $imageName = time() . '.' . $request->poster->extension();
            $request->poster->move(public_path('uploads'), $imageName);
        }

        // $genres = ['Action', 'Comedy', 'Biopic', 'Horror', 'Drama'];

        // if(in_array($request->genre, $genres)) {
        //     $genre = $request->genres;
        // }
        // else {
        //     throw new Exception("Enter valid gener");
            
        // }

        $data = new Movie;
        $data->title = $request->title;
        $data->release_year = $request->release_year;
        $data->poster = $imageName;
        $data->genre = $request->genre;
        $data->user_id = $request->id;
        $data->save();

        return response()->json(['Status' => 'Success', 'Data' => $data], 200);

    }


    public function update(Request $request,$id) {

        $validator = Validator::make($request->all(), [ 
            'title' => 'required',
            'genre' => 'required',
            // 'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json(['Status' => 'Error', 'Error' => $validator->errors()->first()], 403);
        }


        $data = Movie::find($id);

        $imageName = '';
        if ($request->poster) {
            $imageName = time() . '.' . $request->poster->extension();
            $request->poster->move(public_path('uploads'), $imageName);
            $data->poster = $imageName;
        }

        $data->title = $request->title;
        $data->release_year = $request->release_year;
        $data->genre = $request->genre;
        $data->update();

        return response()->json(['Status' => 'Success', 'Data' => $data], 200);

    }



    public function delete($id) {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        return response()->json(['status' => 'success', 'Record has been deleted successfully']);
    }

}
