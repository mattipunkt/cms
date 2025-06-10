<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function showMovieList() {
        return view('movies.main', [
            'movies' => Movie::all()
        ]);
    }


    public function addMovie() {

    }
}
