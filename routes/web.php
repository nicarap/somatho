<?php

use App\Http\Controllers\Dashboard\PatientController as DashboardPatientController;
use App\Http\Controllers\Dashboard\TherapistController as DashboardTherapistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Therapist\PatientController as TherapistPatientController;
use App\Http\Controllers\TherapistController;
use Illuminate\Foundation\Application;
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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/therapist', [DashboardTherapistController::class, 'index'])->name('therapist.dashboard');
    Route::get('/dashboard/patient', [DashboardPatientController::class, 'index'])->name('patient.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('patient', PatientController::class);

    Route::get('therapist/patient/index', [TherapistPatientController::class, 'index'])->name('therapist.patient.index');
    Route::resource('therapist', TherapistController::class);
});

require __DIR__.'/auth.php';
