<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RequestController;

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

// Route::resource('projects', ProjectController::class);
Route::resource('requests', RequestController::class);
Route::resource('offers', OfferController::class);

Route::middleware(['auth:sanctum', 'verified', 'can:accessDashboard'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
