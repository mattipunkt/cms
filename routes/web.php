<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\MovieController;
use App\Livewire\Moviesearch;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

// Movies
Route::get('/movies', [MovieController::class, 'showMovieList'])->name('movies')->middleware('auth');;

// Auth
Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('showLogin');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/auth/register', [AuthController::class, 'register'])->name('showRegister');

Route::get('/movies/add', Moviesearch::class)->middleware('auth');
Route::get('/movies/{id}/edit',  [MovieController::class, 'editMovie'])->name('editMovie')->middleware('auth');
Route::post('/movies/{id}/edit',  [MovieController::class, 'editMoviePost'])->name('editMovie')->middleware('auth');
Route::get('/movies/{id}/delete', [MovieController::class, 'deleteMovie'])->name('deleteMovie')->middleware('auth');
Route::get('/movies/{id}/edit/poster', [ImageController::class, 'editPoster'])->name('editPoster')->middleware('auth');
