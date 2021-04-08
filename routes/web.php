<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\StationDropboxController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/', [App\Http\Controllers\ExploreController::class, 'index']);

Route::view('/dashboard', 'dashboard')->middleware(['auth'])->name('dashboard');
Route::view('/about', 'about')->name('about');

Route::prefix('user')->name('user.')->middleware('auth')->group(function ()
{
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('delete');
});

Route::middleware('auth')
    ->resource('station', StationController::class)
    ->only(['index', 'show', 'store', 'update', 'destroy']);

Route::middleware('auth')
    ->resource('station.dropbox', StationDropboxController::class)
    ->only(['store', 'update', 'destroy']);