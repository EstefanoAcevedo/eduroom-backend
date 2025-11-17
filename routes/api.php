<?php

use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\AttendanceStatesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\CommissionsController;
use App\Http\Controllers\EnrollmentsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('saludo', function () {
    return response()->json(['mensaje' => '¡Hola Mundo!']);
});

/* Authenticated Routes (Requires Sanctum token) */
Route::middleware('auth:sanctum')->group(function () {

    /* Logout */
    Route::post('logout', [AuthController::class, 'logout']);

    /* Users Routes */
    Route::prefix('users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->middleware('role:Admin');
        Route::get('/{id}', [UsersController::class, 'show'])->middleware('role:Admin');
        Route::put('/{id}', [UsersController::class, 'update'])->middleware('role:Admin');
        Route::delete('/{id}', [UsersController::class, 'destroy'])->middleware('role:Admin');
    });

    /* Careers Routes */
    Route::prefix('careers')->group(function () {
        Route::get('/', [CareersController::class, 'index'])->middleware('role:Admin|Teacher|Student');
        Route::post('/', [CareersController::class, 'store'])->middleware('role:Admin');
        Route::get('/{id}', [CareersController::class, 'show'])->middleware('role:Admin|Teacher|Student');
        Route::put('/{id}', [CareersController::class, 'update'])->middleware('role:Admin');
        Route::delete('/{id}', [CareersController::class, 'destroy'])->middleware('role:Admin');
    });
    Route::get('careers-with-subjects', [CareersController::class, 'showWithSubjects'])->middleware('role:Admin|Teacher|Student');

    /* Subjects Routes */
    Route::prefix('subjects')->group(function () {
        Route::get('/', [SubjectsController::class, 'index'])->middleware('role:Admin|Teacher|Student');
        Route::post('/', [SubjectsController::class, 'store'])->middleware('role:Admin');
        Route::get('/{id}', [SubjectsController::class, 'show'])->middleware('role:Admin|Teacher|Student');
        Route::put('/{id}', [SubjectsController::class, 'update'])->middleware('role:Admin');
        Route::delete('/{id}', [SubjectsController::class, 'destroy'])->middleware('role:Admin');
    });
    Route::get('subjects-by-career/{career_id}', [SubjectsController::class, 'showSubjectsByCareer_id'])->middleware('role:Admin|Teacher|Student');
    Route::get('my-subjects', [EnrollmentsController::class, 'mySubjects'])->middleware('role:Student');

    /* Commissions Routes */
    Route::prefix('commissions')->group(function () {
        Route::get('/', [CommissionsController::class, 'index'])->middleware('role:Admin|Teacher|Student');
        Route::post('/', [CommissionsController::class, 'store'])->middleware('role:Admin');
        Route::get('/{id}', [CommissionsController::class, 'show'])->middleware('role:Admin|Teacher|Student');
        Route::put('/{id}', [CommissionsController::class, 'update'])->middleware('role:Admin');
        Route::delete('/{id}', [CommissionsController::class, 'destroy'])->middleware('role:Admin');
    });

    /* Enrollments Routes */
    Route::prefix('enrollments')->group(function () {
        Route::get('/', [EnrollmentsController::class, 'index'])->middleware('role:Admin|Teacher|Student');
        Route::post('/', [EnrollmentsController::class, 'store'])->middleware('role:Admin|Student');
        Route::get('/{id}', [EnrollmentsController::class, 'show'])->middleware('role:Admin|Teacher|Student');
        Route::put('/{id}', [EnrollmentsController::class, 'update'])->middleware('role:Admin');
        Route::delete('/{id}', [EnrollmentsController::class, 'destroy'])->middleware('role:Admin');
    });
    Route::get('enrollments-pending', [EnrollmentsController::class, 'showPendingEnrollments'])->middleware('role:Admin');
    Route::get('/enrollments/{subject_id}/{commission_id}/{academic_year}', [EnrollmentsController::class, 'showApprovedEnrollmentsBySubjectIdAndCommissionIdAndAcademicYear'])->middleware('role:Admin|Teacher');


    /* Attendances Routes */
    Route::prefix('attendances')->group(function () {
        Route::get('/', [AttendancesController::class, 'index'])->middleware('role:Admin|Teacher|Student');
        Route::post('/', [AttendancesController::class, 'store'])->middleware('role:Admin|Teacher');
        Route::get('/{id}', [AttendancesController::class, 'show'])->middleware('role:Admin|Teacher|Student');
        Route::put('/{id}', [AttendancesController::class, 'update'])->middleware('role:Admin|Teacher');
        Route::delete('/{id}', [AttendancesController::class, 'destroy'])->middleware('role:Admin');
    });
    Route::post('/store-multiple-attendances', [AttendancesController::class, 'storeMultipleAttendances'])->middleware('role:Admin|Teacher');
    Route::get('/previous-attendances/{subject_id}/{commission_id}/{date}', [AttendancesController::class, 'showAttendancesBySubjectIdAndCommissionIdAndDate'])->middleware('role:Admin|Teacher');
    Route::put('/update-multiple-attendances', [AttendancesController::class, 'updateMultipleAttendances'])->middleware('role:Admin|Teacher');
    Route::get('my-attendances', [AttendancesController::class, 'myAttendances'])->middleware('role:Student');
    Route::get('/absent-attendances/{subject_id}/{commission_id}/{date}', [AttendancesController::class, 'showAttendancesBySubjectIdAndCommissionIdAndDateWhereStateIsAbsent'])->middleware('role:Admin|Teacher');

    /* Attendance States Routes */
    Route::prefix('attendance_states')->group(function () {
        Route::get('/', [AttendanceStatesController::class, 'index'])->middleware('role:Admin|Teacher|Student');
        Route::post('/', [AttendanceStatesController::class, 'store'])->middleware('role:Admin');
        Route::get('/{id}', [AttendanceStatesController::class, 'show'])->middleware('role:Admin|Teacher|Student');
        Route::put('/{id}', [AttendanceStatesController::class, 'update'])->middleware('role:Admin');
        Route::delete('/{id}', [AttendanceStatesController::class, 'destroy'])->middleware('role:Admin');
    });



    /*Enrollments routes*/
    route::prefix('enrollments')->group(function () {
        Route::get('/', [EnrollmentsController::class, 'index'])->middleware('role:Admin|Teacher|Studentent');
        Route::post('/', [EnrollmentsController::class, 'store'])->middleware('role:Admin|Student');
        Route::get('/{id}', [EnrollmentsController::class, 'show'])->middleware('role:Admin|Teacher|Student');
        Route::put('/{id}', [EnrollmentsController::class, 'update'])->middleware('role:Admin');
        Route::delete('/{id}', [EnrollmentsController::class, 'destoy'])->middleware('role:Admin');
    });
    Route::get('enrollments-pending', [EnrollmentsController::class, 'showPendingEnrollments'])->middleware('role:Admin');
});

/* Public Routes (No authentication required) */

/* Auth */
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

/* Roles */
Route::get('roles', [RoleController::class, 'index']);
