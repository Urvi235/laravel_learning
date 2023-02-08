<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Movie;
use App\Models\User;


class MoviesAPIController extends Controller
{

    public function getMovies($id = null) {

        $movies = $id ? Movie::find($id) : Movie::all();

        if ($id == null) {
            $movies_arr = [];
            foreach ($movies as $key => $value) {
                $value['poster'] = asset('uploads/' . $value->poster);
                array_push($movies_arr, $value);
            }

            return response()->json(['success' => true, 'data' => $movies_arr]);
        }
        else{
            $movies['poster'] = asset('uploads/' . $movies->poster);
            return response()->json(['success' => true, 'data' => $movies]);
        }
    }
    


    public function create(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'title' => 'required',
            'genre' => 'required',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if($validator->fails()) {
            return response()->json(['Status' => 'Fail', 'Error' => $validator->errors()->first()], 403);
        }

        $imageName = '';
        $imgPath = '';
        
        if ($request -> poster) {
            $imageName = time() . '.' . $request->poster->extension();
            $imgPath = $request->poster->move(public_path('uploads'), $imageName);

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
            return response()->json(['Status' => 'Error', 'Error' => $validator->errors()->first()], 401);
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

        return response()->json(['status' => 'success', 'Record has been deleted successfully'], 200);
    }



    public function getUserPosts(Request $request) {
        $user_id = User::find($request->id);
        
        if($user_id) {
            $user_posts = $user_id->posts;
           
            return response()->json(['Status' => 'Success', 'Data' => $user_posts], 200);
        }
        else {
            return response()->json(['Status' => 'Fail', 'message' => 'Can not found user posts'], 401);
        }
    }

}
