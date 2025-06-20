<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use function Laravel\Prompts\error;

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



}
