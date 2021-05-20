<?php

use App\Http\Controllers\DropboxLogControlle;
use App\Http\Controllers\DropboxOperationController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\StationDropboxController;
use App\Http\Controllers\StationMediaController;
use App\Http\Controllers\StationReportController;
use App\Http\Controllers\StationScheduleController;

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
Route::get('/about/{lang?}', [StaticPageController::class, 'about'])->name('about');
Route::view('/policy', 'privacy-policy')->name('privacy-policy');
Route::view('/terms', 'terms-of-service')->name('terms');

Route::prefix('user')->name('user.')->middleware('auth')->group(function ()
{
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('delete');
});

Route::prefix('profile')->name('profile.')->middleware('auth')->group(function ()
{
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('update.password');
});

Route::middleware('auth')
    ->resource('station', StationController::class)
    ->only(['index', 'show', 'store', 'update', 'destroy']);

Route::middleware('auth')
    ->resource('station.dropbox', StationDropboxController::class)
    ->only(['store', 'update', 'destroy']);

Route::middleware('auth')
    ->resource('station.schedule', StationScheduleController::class)
    ->only(['index', 'store', 'update', 'destroy']);

Route::resource('station.media', StationMediaController::class)
    ->only(['index', 'store', 'destroy']);

Route::prefix('operation')->middleware('auth')->name('operation.')->group(function ()
{
    Route::get('/', [OperationController::class, 'index'])->name('index');
    Route::get('/{station}', [OperationController::class, 'show'])->name('show');
    Route::post('/{station}/replace', [OperationController::class, 'replace'])->name('replace');
    Route::post('/{station}/inspect', [OperationController::class, 'inspect'])->name('inspect');
    Route::delete('/{dropboxLog}', [OperationController::class, 'destroy'])->name('destroy');
});

Route::middleware('auth')->prefix('dropboxLog')->name('dropboxLog.')->group(function ()
{
    Route::put('/{dropboxLog}', [DropboxLogControlle::class, 'update'])->name('update');
    Route::delete('/{dropboxLog}', [DropboxLogControlle::class, 'destroy'])->name('destroy');
});

Route::get('/submit-report/{station}', [StationReportController::class, 'create'])->name('report.create');

Route::middleware('auth')->prefix('station/{station}/report')->name('station.report.')->group(function ()
{
    Route::post('/', [StationReportController::class, 'store'])->name('store');
});
