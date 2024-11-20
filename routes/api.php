<?php

use App\Http\Controllers\PatientRegistryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Patient CRUD Routes
Route::apiResource('patients', PatientRegistryController::class);

// Address CRUD Routes
//Route::apiResource('addresses', AddressController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
