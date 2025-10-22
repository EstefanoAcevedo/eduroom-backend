<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\CommissionsController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubjectsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('saludo', function () {
    return response()->json(['mensaje' => '¡Hola Mundo!']);
});

// Authenticated Routes (Requires Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    
    Route::post('logout', [AuthController::class, 'logout']);
    
    // Careers Routes
    Route::prefix('careers')->group(function () {
        Route::get('/', [CareersController::class, 'index'])->middleware('role:Admin|Teacher|Student');
        Route::post('/', [CareersController::class, 'store'])->middleware('role:Admin');
        Route::get('/{id}', [CareersController::class, 'show'])->middleware('role:Admin|Teacher|Student');
        Route::put('/{id}', [CareersController::class, 'update'])->middleware('role:Admin');
        Route::delete('/{id}', [CareersController::class, 'destroy'])->middleware('role:Admin');
    });
    Route::get('careers-with-subjects', [CareersController::class, 'showWithSubjects'])->middleware('role:Admin|Teacher|Student');
    
    // Subjects Routes
    Route::prefix('subjects')->group(function () {
        Route::get('/', [SubjectsController::class, 'index'])->middleware('role:Admin|Teacher|Student');
        Route::post('/', [SubjectsController::class, 'store'])->middleware('role:Admin');
        Route::get('/{id}', [SubjectsController::class, 'show'])->middleware('role:Admin|Teacher|Student');
        Route::put('/{id}', [SubjectsController::class, 'update'])->middleware('role:Admin');
        Route::delete('/{id}', [SubjectsController::class, 'destroy'])->middleware('role:Admin');
    });
    
});

// Public Routes (No authentication required)
/* Auth */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
/* Commissions */
Route::apiResource('commissions', CommissionsController::class);
/* Enrollments */
Route::apiResource('enrollments', EnrollmentsController::class);
/* Roles */
Route::get('roles', [RoleController::class, 'index']);