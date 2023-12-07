<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\PresentasiController;
use App\Http\Controllers\JudulprojekController;

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
    return view('welcome');
});

// route login


// route judul projek
Route::resource('/judulprojek', JudulprojekController::class);

// route Log Book
Route::resource('/logbook', LogbookController::class);

// route presentasi
Route::resource('/presentasi', PresentasiController::class);
