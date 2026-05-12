<?php

use App\Models\Location;
use App\Models\Movie;
use App\Models\Showtime;
use App\Http\Controllers\MovieController;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;



Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('factory:movie', function () {
    Movie::factory()->count(10)->create();
})->purpose('Create Movies for Debugging');

Artisan::command('factory:location', function () {
    Location::factory()->count(3)->create();
}
);

Artisan::command('factory:showtimes', function () {
    Showtime::factory()->count(50)->create();
});

Artisan::command('importArray {path}', function(string $path) {
    $array = json_decode(file_get_contents($path), true);
    foreach ($array[7]['data'] as $showtime) {
        $date = strtotime($showtime['datum'].' '.$showtime['stunde'].':'.$showtime['minute']);
        $movieId = $showtime['filmId'];
        if ($date > time()) {
            $movie = MovieController::getMovieInfoFromId($array[2]['data'], $movieId);
            preg_match('/(?<=\s)\d{4}(?=\s)/', $movie['kurzinfo'], $matches);
            Showtime::create([
                'movie_id' => Movie::firstOrCreate([
                    'title' => $movie['titel'],
                    'year' => $matches[0] ?? '2026',
                ])->id,
                'location_id' => Location::firstOrCreate([
                    'name' => 'Kinobar'
                ])->id,
                'time' => $date,
            ]);
        }
    }
});
