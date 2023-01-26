<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
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
        $request->validate(['title' => 'required',
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
        $data->post_id = Auth::user()->id;
        $data->save();
        // dd($data);
        return redirect()->route('movies.index')->with('success', 'Movie has been added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        // dd(Movie::find($movie->id));
        return view('movies.show', compact('movie'));
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $genres = ['Action', 'Comedy', 'Biopic', 'Horror', 'Drama'];
        return view('movies.edit', compact('movie', 'genres'));
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