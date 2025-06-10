<?php

use Database\Factories\MovieFactory;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('factory:movie', function () {
    \App\Models\Movie::factory()->count(10)->create();
})->purpose('Create Movies for Debugging');
