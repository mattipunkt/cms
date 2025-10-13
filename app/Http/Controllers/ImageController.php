<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

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
        $image = TmdbController::getImageFile($request->input('cover_url'));
        $image = Image::read($image);
        $encoded = $image->encodeByExtension('webp', 75);
        $relativePath = 'posters/'.$id.'.webp';
        Storage::disk('public')->put($relativePath, (string) $encoded);
        $url = Storage::disk('public')->url($relativePath);
        Movie::where('id', $id)->update(['image' => $url]);
        return redirect('/movies/');
    }

    public function editBackdrop(string $id)
    {
        $images = [];
        $movie = Movie::where('id', $id)->first();
        if (! ($movie->tmdb_id === null)) {
            $images = TmdbController::getBackdrops($movie->tmdb_id);
        }

        return view('movies.backdrop', [
            'movie' => $movie,
            'images' => $images,
        ]);
    }

    public function setBackdrop(string $id, Request $request)
    {
        $image = TmdbController::getImageFile($request->input('cover_url'));
        $image = Image::read($image);
        $encoded = $image->encodeByExtension('webp', 75);
        $relativePath = 'backdrops/'.$id.'.webp';
        Storage::disk('public')->put($relativePath, (string) $encoded);
        $url = Storage::disk('public')->url($relativePath);
        Movie::where('id', $id)->update(['backdrop' => $url]);
        return redirect('/movies/');
    }
}
