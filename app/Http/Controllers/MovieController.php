<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Laravel\Facades\Image;
use function Laravel\Prompts\error;

class MovieController extends Controller
{
    public function showMovieList(Request $request)
    {

        return view('movies.main', [
            'movies' => Movie::all(),
        ]);
    }

    public function addMovie(string $tmdb_id)
    {
        return redirect('/movies/');
    }

    public function editMovie(string $id)
    {
        return view('movies.edit', [
            'movie' => Movie::where('id', $id)->first(),
        ]);
    }

    public function editMoviePost(string $id, Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:255',
            ]);
        } catch (ValidationException) {
            error('You shall add a title!');
        }
        Movie::where('id', $id)->update([
            'title' => $request->title,
            'year' => strtotime('01-01-'.$request->year),
            'director' => $request->director,
            'actors' => $request->actors,
            'genre' => $request->genre,
            'country' => $request->country,
            'description' => $request->description,
            'trailer_url' => $request->trailer_url,
            'runtime' => $request->runtime,
        ]);

        return redirect('/movies/');
    }

    public function deleteMovie(string $id)
    {
        try {
            Movie::where('id', $id)->delete();
        } catch (QueryException $ex) {
            session()->flash('error', 'Movie not found! ');

            return redirect('/movies/');
        }

        return redirect('/movies/');
    }

    public function addMovieMan(Request $request)
    {
        return view('movies.manually');
    }

    public function saveMovieMan(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:255',
            ]);
        } catch (ValidationException) {
            session()->flash('error', 'You shall not add a movie without a title!');
        }
        Movie::create([
            'title' => $request->title,
            'year' => strtotime('01-01-'.$request->year),
            'director' => $request->director,
            'actors' => $request->actors,
            'genre' => $request->genre,
            'country' => $request->country,
            'description' => $request->description,
            'trailer_url' => $request->trailer_url,
            'runtime' => $request->runtime,
        ]);

        return redirect('/movies/');
    }

    public function changePosterMan(string $id, Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|max:4096', // 2MB Max
            ]);
        } catch (ValidationException $e) {
            session()->flash('error', 'Error: You shall upload an image!');

            return redirect('/movies/');
        }
        $image = Image::read($request->image);
        if($image->width() < 500) {
            session()->flash('error', 'Warning: Image is too small and may not look good on large screen devices!');
        }
        $encoded = $image->encodeByExtension('webp', 80);
        $relativePath = 'posters/'.$id.'.webp';
        Storage::disk('public')->put($relativePath, (string) $encoded);
        $url = Storage::disk('public')->url($relativePath);
        Movie::where('id', $id)->update(['image' => $url]);
        return redirect('/movies/');
    }

}
