<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'title' => 'required|max:255',

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
