<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\PresentasiController;
use App\Http\Controllers\JudulprojekController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\LaporanController;
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

// route report & cetak pdf
Route::get('/laporan', [LaporanController::class, 'laporan'])->middleware('auth');
Route::get('/laporan/view', [LaporanController::class, 'viewPdf'])->middleware('auth');
Route::get('/laporan/filter', [LaporanController::class, 'laporanFilter'])->middleware('auth');

// authenticate register dan login
Route::prefix('auth')->group(function () {
    // Register user
    // Route::get('/register', [AuthController::class, 'indexRegister']);
    // Route::post('/register', [AuthController::class, 'store']);

    // login
    Route::get('/login', [AuthController::class, 'indexLogin'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'authenticate']);

    // logout
    Route::post('/logout', [AuthController::class, 'logout']);
});


// Verifikasi Email
// send verify
Route::post('/email/verification-notification/{id}', [AuthController::class, 'sendVerifyEmail'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

// verified
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verified'])
    // ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// notice verify
Route::get('/email/verify', [AuthController::class, 'verifyEmailNotice'])
    ->middleware('auth')
    ->name('verification.notice');
