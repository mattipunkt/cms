<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TmdbController extends Controller
{
    public static function getPosters(string $tmdbid)
    {
        $resp = self::makeRequest('movie/'.$tmdbid.'/images?include_image_language=de,en');

        return array_slice($resp->posters, 0, 15);
    }

    public static function makeRequest(string $url)
    {
        $response = Http::withToken(config('services.tmdb.key'))
            ->acceptJson()
            ->timeout(20)
            ->connectTimeout(10)
            ->retry(3, 200)
            ->withHeaders([
                'Accept-Encoding' => 'identity',
            ])
            ->get('https://api.themoviedb.org/3/'.$url);

        if ($response->failed()) {
            logger()->error('TMDB API error', [
                'url' => $url,
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return null;
        }

        return $response->object();
    }

    public static function getImageFile(string $url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function getBackdrops(mixed $tmdb_id)
    {
        $resp = self::makeRequest('movie/'.$tmdb_id.'/images');
        return array_slice($resp->backdrops, 0, 15);
    }
}
