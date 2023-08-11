<?php

use App\Http\Controllers\TherapistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Therapist\PatientController as TherapistPatientController;
use App\Http\Controllers\TraitmentController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');    
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('patient', PatientController::class);
    Route::get('/test', function (Request $request) {
        return Inertia::render('Traitment/Create', ['therapist' => $request->user()]);
    });

    Route::get('therapist/{therapist}/dashboard', [TherapistController::class, 'dashboard'])->name('therapist.dashboard');
    Route::get('therapist/{therapist}/agenda', [TherapistController::class, 'agenda'])->name('therapist.agenda');
    Route::resource('therapist', TherapistController::class);
    Route::resource('{therapist}/patient', TherapistPatientController::class);
    
    Route::post('therapist/{therapist}/traitment', [TraitmentController::class, 'store'])->name('therapist.traitment.store');
    Route::put('therapist/{therapist}/traitment', [TraitmentController::class, 'update'])->name('therapist.traitment.update');

    Route::resource('user', UserController::class);
});

require __DIR__.'/auth.php';
require __DIR__.'/api.php';
