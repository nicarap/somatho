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
Route::get('/somatopathy', Somatopathy::class)->name('somatopathy');
Route::get('/traitments', Traitment::class)->name('traitment');
Route::get('/articles', Articles::class)->name('articles');
Route::get('articles/{article:slug}', ArticleComponent::class)->name('article');

Route::get('/invoice', function () {
    return view("pdf.invoice", ["invoice" => App\Models\Invoice::first()]);
});
Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get("/admin/invoice/{invoice:number}", [DashboardController::class, "getinvoice"])->name("invoice"); // OK
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
