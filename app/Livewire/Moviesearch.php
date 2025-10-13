<?php

namespace App\Livewire;

use App\Http\Controllers\TmdbController;
use App\Models\Movie;
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
        $curl = curl_init();
        $results = $this->makeRequest('search/movie?query='.str_replace(' ', '+', $this->query).'&language='.env('TMDB_LANG', 'en-US'));
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

    public function addMovie($tmdb_id)
    {
        $results = $this->makeRequest('movie/'.$tmdb_id.'?language='.env('TMDB_LANG', 'en-US'));
        if ($results == null) {
            session()->flash('error', 'No results found or API Limit may be exceeded');
        }
        $credits = $this->makeRequest('movie/'.$tmdb_id.'/credits?language='.env('TMDB_LANG', 'en-US'));
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
                    $actors = $actors.$credit->name.', ';
                }
            } else {
                if ($credit->known_for_department == 'Acting') {
                    $actors = $actors.$credit->name;
                }
                break;
            }
            $i++;
        }
        $movie = new Movie;
        $movie->title = $results->title ?? null;
        $movie->year = strtotime($results->release_date) ?? null;
        $movie->director = $director ?? null;
        $movie->actors = $actors ?? null;
        $movie->genre = implode(', ', array_map(function ($genre) {
            return $genre->name;
        }, $results->genres)) ?? null;
        $movie->country = implode(', ', $results->origin_country) ?? null;
        $movie->description = $results->overview ?? null;
        $movie->image = 'https://image.tmdb.org/t/p/w1280/'.$this->makeRequest('movie/'.$tmdb_id.'/images')->posters[0]->file_path;
        $movie->runtime = $results->runtime;
        $movie->tmdb_id = $results->id;
        $movie->save();
        $image = Image::read(TmdbController::getImageFile($movie->image));
        $encoded = $image->encodeByExtension('webp', 80);
        $relativePath = 'posters/'.$movie->id.'.webp';
        Storage::disk('public')->put($relativePath, (string) $encoded);
        $url = Storage::disk('public')->url($relativePath);
        Movie::where('id', $movie->id)->update(['image' => $url]);

        $backdrop_url = TmdbController::getBackdrops($results->id)[0]->file_path;
        $image = Image::read(TmdbController::getImageFile('https://image.tmdb.org/t/p/original/'.$backdrop_url));
        $encoded = $image->encodeByExtension('webp', 80);
        $relativePath = 'backdrops/'.$movie->id.'.webp';
        Storage::disk('public')->put($relativePath, (string) $encoded);
        $url = Storage::disk('public')->url($relativePath);
        $movie->backdrop = $url;
        $movie->save();
        return $this->redirect('/movies/');
    }

    public function makeRequest(string $url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.themoviedb.org/3/'.$url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer '.env('TMDB_KEY', ''),
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }
}
