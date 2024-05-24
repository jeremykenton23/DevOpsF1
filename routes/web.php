<?php

use App\Http\Controllers\RaceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/laps', [\App\Http\Controllers\LapsController::class, 'index'])->name('laps.index');
    Route::post('/laps', [LapsController::class, 'store'])->name('laps.store');
    Route::get('/laps/create', [\App\Http\Controllers\LapsController::class, 'create'])->name('laps.create');
    Route::post('/laps/store', [\App\Http\Controllers\LapsController::class, 'store'])->name('laps.store');
    Route::get('/laps/{lap}/edit', [\App\Http\Controllers\LapsController::class, 'edit'])->name('laps.edit');
    Route::put('/laps/{lap}/update', [\App\Http\Controllers\LapsController::class, 'update'])->name('laps.update'); // Use PUT for updating laps
    Route::put('/laps/ajax-validate/{lap}', [\App\Http\Controllers\LapsController::class, 'ajaxValidate'])->name('laps.ajax-validate'); // Use POST for validation
    Route::put('/laps/ajax-unvalidate/{lap}', [\App\Http\Controllers\LapsController::class, 'ajaxUnvalidate'])->name('laps.ajax-unvalidate'); // Use POST for unvalidation
    Route::get('/laps/filter', [\App\Http\Controllers\LapsController::class, 'filter'])->name('laps.filter');
    Route::delete('/laps/destroy', [\App\Http\Controllers\LapsController::class, 'destroy'])->name('laps.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('leaderboard.index');

});

Route::middleware('auth')->group(function () {
    Route::get('/races', [RaceController::class, 'index'])->name('races.index');
    Route::get('/races/edit', [RaceController::class, 'edit'])->name('races.edit');
    Route::patch('/races', [RaceController::class, 'update'])->name('races.update');
    Route::delete('/races', [RaceController::class, 'destroy'])->name('races.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/statistics', [\App\Http\Controllers\StatisticsController::class, 'index'])->name('statistics.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/prizes', [\App\Http\Controllers\PrizeController::class, 'index'])->name('prizes.index');
    Route::post('/prizes/achieve/{prize}', [\App\Http\Controllers\PrizeController::class, 'achieve'])->name('prizes.achieve');
});

    require __DIR__.'/auth.php';
