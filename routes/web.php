<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\PresentasiController;
use App\Http\Controllers\JudulprojekController;
use App\Http\Controllers\KoordinatorController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
})->middleware(['auth', 'verified']);


// route judul projek
Route::resource('/judulprojek', JudulprojekController::class)->middleware('auth');

// route Log Book
Route::resource('/logbook', LogbookController::class)->middleware('auth');

// route presentasi
Route::resource('/presentasi', PresentasiController::class)->middleware('auth');

// route pembimbing
Route::resource('/pembimbing', PembimbingController::class)->middleware('auth');

// route pembimbing
Route::resource('/koordinator', KoordinatorController::class)->middleware('auth');

// route mahasiswa
Route::resource('/mahasiswa', MahasiswaController::class)->middleware('auth');

// authenticate register dan login
Route::prefix('auth')->group(function () {
    // Register user
    // Route::get('/register', [AuthController::class, 'indexRegister']);
    // Route::post('/register', [AuthController::class, 'store']);

    // login
    Route::get('/login', [AuthController::class, 'indexLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    // logout
    Route::post('/logout', [AuthController::class, 'logout']);
});

//sending verify
Route::get('/email/verify', function () {
    return view('mahasiswa.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request, $id, $hash) {

    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
