<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\CommissionsController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\SubjectsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/saludo', function (Request $request) {
    return response()->json(['mensaje' => 'Hola Mundo']);
});

// Public Routes (No authentication required)

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Authenticated Routes (Requires Sanctum token)

/* Careers */
Route::apiResource('careers', CareersController::class);
Route::get('careers-with-subjects', [CareersController::class, 'showWithSubjects']); 

/* Subjects */
Route::apiResource('subjects', SubjectsController::class);

/* Commissions */
Route::apiResource('commissions', CommissionsController::class);

/* Enrollments */
Route::apiResource('enrollments', EnrollmentsController::class);