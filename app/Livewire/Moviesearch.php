<?php

namespace App\Livewire;

use Livewire\Component;
use stdClass;

class Moviesearch extends Component
{
    public array $searchResults = [];
    public string $query = '';
    public function render()
    {
        return view('livewire.moviesearch')->with('searchResults', $this->searchResults)->layout('components.layout');
    }

    public function search() {
        $this->searchResults = [];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.themoviedb.org/3/search/movie?query='.str_replace(' ', '+', $this->query),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.env('TMDB_KEY', '')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $results = json_decode($response);
        if($results == null) {
            session()->flash('error', 'No results found or API Limit may be exceeded');
        } else {
            $results = $results->results;
            foreach ($results as $result) {
                $this->searchResults[] = [
                    'title' => $result->title,
                    'id' => $result->id,
                    'description' => $result->overview,
                ];
            }
        }
    }
}
