<?php

use App\Http\Controllers\FaqController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ListingController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('listings', ListingController::class);
Route::get('map', MapController::class)->name('map');
Route::get('faq', FaqController::class)->name('faq');

Route::middleware(['auth:sanctum', 'can:accessDashboard', 'verified', '2fa'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/api/discord/ping', [App\Http\Controllers\DiscordController::class, 'ping'])->middleware('auth:sanctum');
