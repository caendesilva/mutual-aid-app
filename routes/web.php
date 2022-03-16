<?php

use App\Models\User;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\NoticeController;
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
Route::get('map', MapController::class);

Route::middleware(['auth:sanctum', 'verified', 'can:accessDashboard'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('notices.txt', NoticeController::class);
