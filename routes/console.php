<?php

use App\Models\Location;
use App\Models\Movie;
use App\Models\Showtime;
use App\Http\Controllers\MovieController;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;



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
    $kategorien = $array[3]['data'];
    foreach ($array[7]['data'] as $showtime) {
        $date = strtotime($showtime['datum'].' '.$showtime['stunde'].':'.$showtime['minute']);
        $movieId = $showtime['filmId'];
        if ($date > time()) {
            $movie = MovieController::getMovieInfoFromId($array[2]['data'], $movieId);
            preg_match('/(?<=\s)\d{4}(?=\s)/', $movie['kurzinfo'], $matches);
            $event = null;
            if ($showtime['kategorieId'] == '1') {
                $movie['event'] = null;
            } else {
                foreach ($kategorien as $kategorie) {
                    if ($kategorie['kategorieId'] == $showtime['kategorieId']) {
                        $event = \App\Models\Event::firstOrCreate([
                            'name' => $kategorie['name'],
                        ]);
                        break;
                    }
                }
            }
            $location = Location::firstOrCreate([
                'name' => 'Kinobar'
            ])->id;
            if ($showtime['kategorieId'] == '381') {
                $location = Location::firstOrCreate([
                    'name' => 'Sommerkino auf der Feinkost'
                ])->id;
            }
            Showtime::create([
                'movie_id' => Movie::firstOrCreate([
                    'title' => $movie['titel'],
                    'year' => $matches[0] ?? '2026',
                ])->id,
                'location_id' => $location,
                'event_id' => $event->id ?? null,
                'time' => $date,
            ]);
        }
    }
});


Artisan::command('admin:reset-pw {pw}', function (string $pw) {
    $user = User::find(1);

    if (!$user) {
        $this->error('User mit ID 1 wurde nicht gefunden!');
        return;
    }

    $user->password = Hash::make($pw);
    $user->save();

    $this->info('Passwort für Admin erfolgreich zurückgesetzt!');
});
