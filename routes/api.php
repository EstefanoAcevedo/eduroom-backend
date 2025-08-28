<?php

use App\Http\Controllers\CareersController;
use App\Http\Controllers\SubjectsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/saludo', function (Request $request) {
    return response()->json(['mensaje' => 'Hola Mundo']);
});

Route::apiResource('careers', CareersController::class);
Route::get('careers-with-subjects', [CareersController::class, 'showWithSubjects']); 

Route::apiResource('subjects', SubjectsController::class);