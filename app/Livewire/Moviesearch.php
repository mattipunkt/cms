<?php

namespace App\Livewire;

use App\Http\Controllers\TmdbController;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Livewire\Component;

class Moviesearch extends Component
{
    public array $searchResults = [];

    public string $query = '';

    public function render(Request $request)
    {
        $tmdb_id = $request->query('tmdb_id');
        if ($tmdb_id) {
            $this->addMovie($tmdb_id);
        }

        return view('livewire.moviesearch')->with('searchResults', $this->searchResults)->layout('components.layout');
    }

    public function search()
    {
        $this->searchResults = [];
        $results = TmdbController::makeRequest('search/movie?query='.str_replace(' ', '+', $this->query).'&language='.config('services.tmdb.language'));
        if ($results == null) {
            session()->flash('error', 'No results found or API Limit may be exceeded');
        } else {
            $results = $results->results;
            foreach ($results as $result) {
                $this->searchResults[] = [
                    'title' => $result->title,
                    'year' => $result->release_date,
                    'id' => $result->id,
                    'description' => $result->overview,
                ];
            }
        }
    }

    public static function addTmdbMovie($tmdb_id, $id = null): void
    {
        $results = TmdbController::makeRequest('movie/' . $tmdb_id . '?language=' . config('services.tmdb.language'));
        if ($results == null) {
            session()->flash('error', 'No results found or API Limit may be exceeded');
        }
        $credits = TmdbController::makeRequest('movie/' . $tmdb_id . '/credits?language=' . config('services.tmdb.language'));
        $director = '';
        foreach ($credits->crew as $credit) {
            if ($credit->job == 'Director') {
                $director = $credit->name;
                break;
            }
        }
        $actors = '';
        $i = 0;
        foreach ($credits->cast as $credit) {
            if ($i < 5) {
                if ($credit->known_for_department == 'Acting') {
                    $actors = $actors . $credit->name . ', ';
                }
            } else {
                if ($credit->known_for_department == 'Acting') {
                    $actors = $actors . $credit->name;
                }
                break;
            }
            $i++;
        }
        if ($id == null) {
            $movie = new Movie;
        } else {
            $movie = Movie::find($id);
            $tmdb_id_merge = Movie::where('tmdb_id', $tmdb_id)->first();
            if ($tmdb_id_merge != null) {
                foreach(Showtime::where('movie_id', $tmdb_id_merge->id) as $showtime) {
                    $showtime->movie_id = $movie->id;
                    $showtime->save();
                }
                $movie->delete();
                return;
            }
        }
        $movie->title = $results->title ?? null;
        $movie->year = strtotime($results->release_date) ?? null;
        $movie->director = $director ?? null;
        $movie->actors = $actors ?? null;
        $movie->genre = implode(', ', array_map(function ($genre) {
            return $genre->name;
        }, $results->genres)) ?? null;
        $movie->country = implode(', ', $results->origin_country) ?? null;
        $movie->description = $results->overview ?? null;
        $movie->image = 'https://image.tmdb.org/t/p/w1280/' . TmdbController::makeRequest('movie/' . $tmdb_id . '/images')->posters[0]->file_path;
        $movie->runtime = $results->runtime;
        $movie->tmdb_id = $results->id;
        $movie->save();
        $image = Image::read(TmdbController::getImageFile($movie->image));
        $encoded = $image->encodeByExtension('webp', 80);
        $relativePath = 'posters/' . $movie->id . '.webp';
        Storage::disk('public')->put($relativePath, (string)$encoded);
        $url = Storage::disk('public')->url($relativePath);
        Movie::where('id', $movie->id)->update(['image' => $url]);
        try {
            $backdrop_url = TmdbController::getBackdrops($results->id)[0]->file_path;
            $image = Image::read(TmdbController::getImageFile('https://image.tmdb.org/t/p/original/' . $backdrop_url));
            $encoded = $image->encodeByExtension('webp', 80);
            $relativePath = 'backdrops/' . $movie->id . '.webp';
            Storage::disk('public')->put($relativePath, (string)$encoded);
            $url = Storage::disk('public')->url($relativePath);
            $movie->backdrop = $url;
        } catch (\Exception $e) {
            session()->flash('error', 'No backdrop found');
        }
        $movie->save();
    }

    public function addMovie($tmdb_id,)
    {
        self::addTmdbMovie($tmdb_id);
        return $this->redirect('/movies/');
    }

}
