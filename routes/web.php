<?php

use App\Http\Controllers\ExportUserTimeEntriesController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->get('users/{user}/export-time-entries', ExportUserTimeEntriesController::class);

Route::get('/auth/{view?}', fn() => view('app'))
    ->where('view', '^(?!(api)).*$')
    ->middleware('guest');

Route::get('{view?}', fn() => view('app'))
    ->where('view', '^(?!(api)).*$')
    ->middleware('auth');
