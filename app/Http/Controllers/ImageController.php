<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function editPoster(string $id)
    {
        $images = [];
        $movie = Movie::where('id', $id)->first();
        if (! ($movie->tmdb_id === null)) {
            $images = TmdbController::getPosters($movie->tmdb_id);
        }

        return view('movies.poster', [
            'movie' => $movie,
            'images' => $images,
        ]);
    }

    public function setPoster(string $id, Request $request)
    {
        $movie = Movie::where('id', $id)->first();
        $movie->image = $request->input('cover_url');
        $movie->save();

        return redirect('/movies/'.$id.'/edit/');
    }
}
