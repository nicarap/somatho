<?php

use Inertia\Inertia;
use App\Models\Article;
use App\Livewire\Pages\Home;
use Illuminate\Http\Request;
use App\Livewire\Pages\About;
use App\Livewire\Pages\Articles;
use App\Livewire\Pages\Article as ArticleComponent;
use App\Livewire\Pages\Traitment;
use App\Livewire\Pages\Somatopathy;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\Therapist\AddressController as TherapistAddressController;
use App\Http\Controllers\Therapist\PatientController as TherapistPatientController;
use App\Http\Controllers\Therapist\TraitmentController as TherapistTraitmentController;

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


Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/somatopathy', Somatopathy::class)->name('somatopathy');
Route::get('/traitments', Traitment::class)->name('traitments');
Route::get('/articles', Articles::class)->name('articles');
Route::get('articles/{article:slug}', ArticleComponent::class)->name('article');


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

    Route::resource('therapist', TherapistController::class);

    Route::prefix('therapist/{therapist}')->name('therapist.')->group(function () {
        Route::resource('/patient', TherapistPatientController::class);
        Route::get('dashboard', [TherapistController::class, 'dashboard'])->name('dashboard');
        Route::get('agenda', [TherapistController::class, 'agenda'])->name('agenda');

        Route::resource('traitment', TherapistTraitmentController::class)->only(['update', 'store']);
        Route::delete('/traitment/{traitment}', [TherapistTraitmentController::class, 'destroy'])->name('traitment.destroy');

        Route::put('/address/{address}/edit', [TherapistAddressController::class, 'changeDefaultAddress'])->name('address.changeDefaultAddress');
    });

    Route::resource('user', UserController::class);

    Route::resource('address', AddressController::class);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
