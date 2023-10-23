<?php

use App\Http\Controllers\api\Therapist\PatientController as TherapistPatientController;
use App\Http\Controllers\api\Therapist\AddressController as TherapistAddressController;
use App\Http\Controllers\api\Patient\AddressController as PatientAddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::get('therapist/{therapist}/patients/index', [TherapistPatientController::class, 'index'])->name('therapist.patients.index');
    Route::get('therapist/{therapist}/address', [TherapistAddressController::class, 'index'])->name('therapist.address.index');
    Route::get('patient/{user}/address', [PatientAddressController::class, 'index'])->name('patient.address.index');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
