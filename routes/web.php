<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MovieController;
use App\Livewire\Moviesearch;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Movies
Route::get('/movies', [MovieController::class, 'showMovieList'])->name('movies')->middleware('auth');

// Auth
Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('showLogin');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth/register', [AuthController::class, 'register'])->name('showRegister');

Route::get('/movies/add', Moviesearch::class)->middleware('auth');
Route::get('/movies/{id}/edit', [MovieController::class, 'editMovie'])->name('editMovie')->middleware('auth');
Route::post('/movies/{id}/edit', [MovieController::class, 'editMoviePost'])->name('editMovie')->middleware('auth');
Route::get('/movies/{id}/delete', [MovieController::class, 'deleteMovie'])->name('deleteMovie')->middleware('auth');
Route::get('/movies/{id}/edit/poster', [ImageController::class, 'editPoster'])->name('editPoster')->middleware('auth');
Route::post('/movies/{id}/edit/poster', [ImageController::class, 'setPoster'])->name('setPoster')->middleware('auth');
Route::get('/movies/add/man', [MovieController::class, 'addMovieMan'])->name('addMovieMan')->middleware('auth');
Route::post('/movies/add/man', [MovieController::class, 'saveMovieMan'])->name('saveMovieMan')->middleware('auth');

Route::post('movies/{id}/edit/poster/man', [MovieController::class, 'changePosterMan'])->name('changePosterMan')->middleware('auth');

Route::get('/locations', [LocationController::class, 'showLocations'])->name('showLocations')->middleware('auth');
Route::get('/locations/add', [LocationController::class, 'addLocation'])->name('addLocation')->middleware('auth');
Route::post('/locations/add', [LocationController::class, 'addLocationPost'])->name('addLocation')->middleware('auth');
Route::get('/locations/{id}/delete', [LocationController::class, 'deleteLocation'])->name('deleteLocation')->middleware('auth');

Route::get('/planner', [\App\Http\Controllers\ProgramPlannerController::class, 'showPlanner'])->name('showPlanner')->middleware('auth');
Route::post('planner/{id}/showtime/add', [\App\Http\Controllers\ProgramPlannerController::class, 'addShowtime'])->name('addShowtime')->middleware('auth');
