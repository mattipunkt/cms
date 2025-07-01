<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Http\Controllers\TmdbController;

class ImageController extends Controller
{
    //
    public function editPoster(string $id)
    {
        $movie = Movie::where('id', $id)->first();
        return view('movies.poster', [
            "movie" => $movie,
            "images" => TmdbController::getPosters($movie->tmdb_id)
        ]);
    }

    public function setPoster(string $id, Request $request) {
        $movie = Movie::where('id', $id)->first();
        $movie->image = $request->input('cover_url');
        $movie->save();
        return redirect('/movies/'.$id.'/edit/');
    }
}
