<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

// Movies
Route::get('/movies', [MovieController::class, 'showMovieList'])->name('movies');

// Auth
Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/auth/login', [AuthController::class, 'login'])->name('showLogin');
Route::post('/auth/register', [AuthController::class, 'register'])->name('showRegister');

Route::get('/movies/add', \App\Livewire\Moviesearch::class);
