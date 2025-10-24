<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('artists', ArtistController::class);
Route::resource('albums', AlbumController::class);
// Route::get('/artists', [App\Http\Controllers\ArtistController::class, 'index'])->name('artists.index');
// Route::get('/artists/create', [App\Http\Controllers\ArtistController::class, 'create'])->name('artists.create');
// Route::post('/artists/store', [App\Http\Controllers\ArtistController::class, 'store'])->name('artists.store');
