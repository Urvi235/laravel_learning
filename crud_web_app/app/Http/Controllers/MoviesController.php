<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\carbon;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {

        $movies = Movie::latest()->paginate(3);
        return view('movies.index', compact('movies'))->with('i', (request()->input('page', 1)));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function create()
    {

        $genres = ['Action', 'Comedy', 'Biopic', 'Horror', 'Drama'];
        return view('movies.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        $imageName = '';
        if ($request->poster) {
            $imageName = time() . '.' . $request->poster->extension();
            $request->poster->move(public_path('uploads'), $imageName);
        }

        $data = new Movie;
        $data->title = $request->title;
        $data->genre = $request->genre;
        $data->release_year = $request->release_year;
        $data->poster = $imageName;
        $data->user_id = Auth::user()->id;
        $data->save();
        // dd($data);
        return redirect()->route('movies.index')->with('success', 'Movie has been added successfully.');
    }


    public function show(Movie $movie)
    {
        $comment = Movie::find($movie->id)->comment;
        $user_id = Movie::find($movie->id)->user_id;
        $added_by = Movie::find($movie->id)->user->name;
        $comment_id = Comment::where('movie_id', $movie->id)->with('user')->get();


        return view('movies.show', compact('movie', 'added_by', 'user_id','comment','comment_id'));
    }



    public function userAllPost(Request $request, $id)
    {
        // dd(User::with('posts')->get()); get all get of both the columns ..
        $user_posts = User::find($id)->posts;
        return view('movies/userPost', compact('user_posts'));

    }




    public function edit(Movie $movie)
    {
        // dd(Auth::user()->id);
        if (Auth::user()->id == $movie->user_id){
            $genres = ['Action', 'Comedy', 'Biopic', 'Horror', 'Drama'];
            return view('movies.edit', compact('movie', 'genres'));
        }
        else{
            return redirect()->route('movies.index')->with('sorry', 'You have no access to update this post.'); 
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
        ]);

        $imageName = '';
        if ($request->poster) {
            $imageName = time() . '.' . $request->poster->extension();
            $request->poster->move(public_path('uploads'), $imageName);
            $movie->poster = $imageName;
        }

        $movie->title = $request->title;
        $movie->genre = $request->genre;
        $movie->release_year = $request->release_year;
        $movie->update();
        return redirect()->route('movies.index')->with('success', 'Movie has been updated successfully.');

    }


    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $data = new Comment;
        $data->comment = $request->comment;
        $data->movie_id = $request->id;
        $data->user_id = Auth::user()->id;
        $data->save();

        return redirect()->route('movies.index')->with('comment', 'Comment has been added successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Movie has been deleted successfully.');
    }
}