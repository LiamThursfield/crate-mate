<?php

use App\Http\Controllers\Library\LibraryArtistController;
use App\Http\Controllers\Library\LibraryTrackController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])
    ->prefix('my-library')
    ->name('my-library.')
    ->group(
        function () {
            Route::resource('artist', LibraryArtistController::class)->only(['index']);
            Route::resource('track', LibraryTrackController::class)->only(['index']);
        }
    );

require __DIR__.'/settings.php';
