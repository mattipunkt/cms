<?php

namespace App\Http\Controllers;

class TmdbController extends Controller
{
    public static function getPosters(string $tmdbid)
    {
        $resp = self::makeRequest('movie/'.$tmdbid.'/images?include_image_language=de,en');

        return array_slice($resp->posters, 0, 15);
    }

    public static function makeRequest(string $url)
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
