<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use function Laravel\Prompts\error;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function showMovieList(Request $request) {

        return view('movies.main', [
            'movies' => Movie::all()
        ]);
    }


    public function addMovie(int $tmdb_id) {
        return redirect('/movies/');
    }

    public function editMovie(int $id) {
        return view('movies.edit', [
            'movie' => Movie::where('id', $id)->first()
        ]);
    }

    public function editMoviePost(int $id, Request $request) {
        try {
            $request->validate([
                'title' => 'required|max:255',
            ]);
        } catch (ValidationException) {
            error("You shall add a title!");
        }
        Movie::where('id', $id)->update([
            'title' => $request->title,
            'year' =>  strtotime("01-01-".$request->year),
            'director' =>  $request->director,
            'actors' =>  $request->actors,
            'genre' =>  $request->genre,
            'country' =>  $request->country,
            'description' =>  $request->description,
            'trailer_url' =>   $request->trailer_url,
            'runtime' =>   $request->runtime,
        ]);
        return redirect('/movies/');
    }

    public function deleteMovie(int $id) {
        try {
            Movie::where('id', $id)->delete();
        } catch (QueryException $ex) {
            session()->flash('error', 'Movie not found! ');
            return redirect('/movies/');
        }
        return redirect('/movies/');
    }

    public function addMovieMan(Request $request) {
        return view('movies.manually');
    }

    public function saveMovieMan(Request $request) {
        try {
            $request->validate([
                'title' => 'required|max:255',
            ]);
        } catch (ValidationException) {
            session()->flash('error', 'You shall not add a movie without a title!');
        }
        Movie::create([
            'title' => $request->title,
            'year' =>  strtotime("01-01-".$request->year),
            'director' =>  $request->director,
            'actors' =>  $request->actors,
            'genre' =>  $request->genre,
            'country' =>  $request->country,
            'description' =>  $request->description,
            'trailer_url' =>   $request->trailer_url,
            'runtime' =>   $request->runtime,
        ]);
        return redirect('/movies/');
    }

    public function changePosterMan(int $id, Request $request) {
        try {
            $request->validate([
                'image' => 'required|image|max:4096', // 2MB Max
            ]);
        } catch (ValidationException $e) {
            session()->flash('error', 'Error: You shall upload an image!');
            return redirect('/movies/'); 
        }
        $path = $request->image->store('images', 'public');
        Movie::where('id', $id)->update(['image' => Storage::url($path)]);
        return redirect('/movies/');
    }

}
