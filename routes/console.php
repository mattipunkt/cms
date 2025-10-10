<?php

use App\Models\Location;
use App\Models\Movie;
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
