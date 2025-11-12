<?php

namespace App\Http\Controllers;

use App\Models\Enrollments;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EnrollmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $enrollments = Enrollments::all();
            return response()->json($enrollments);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudieron obtener las inscripciones',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate(([
                'enrollment_academic_year' => 'required|date_format:Y',
                'enrollment_status' => 'required|in:pending,approved,rejected',
                'user_id' => 'required|int',
                'subject_id' => 'required|int',
                'commission_id' => 'required|int'
            ]));
            $enrollment = Enrollments::create($request->all());
            return response()->json([
                'message' => 'Inscripción creada exitosamente',
                'data' => $enrollment,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo crear la inscripción, verifique la validez de los datos enviados',
                'error' => $e->validator->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo crear la inscripción',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $enrollment = Enrollments::findOrFail($id);
            return response()->json($enrollment);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'La inscripción solicitada no existe'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo obtener la inscripción',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enrollments $enrollments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate(([
                'enrollment_academic_year' => 'required|date_format:Y',
                'enrollment_status' => 'required|in:pending,approved,rejected',
                'user_id' => 'required|int',
                'subject_id' => 'required|int',
                'commission_id' => 'required|int'
            ]));
            $enrollment = Enrollments::findOrFail($id);
            $enrollment->update($request->all());
            return response()->json([
                'message' => 'Inscripción actualizada exitosamente',
                'data' => $enrollment,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo actualizar la inscripción, verifique la validez de los datos enviados',
                'error' => $e->validator->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'La inscripción solicitada no existe'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo actualizar la inscripción',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $enrollment = Enrollments::findOrFail($id);
            $enrollment->delete();
            return response()->json([
                'message' => 'Inscripción eliminada exitosamente',
                'data' => $enrollment,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'La inscripción solicitada no existe'
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo eliminar la inscripción',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function showPendingEnrollments()
    {
        try {
            $enrollments = Enrollments::where('enrollment_status', 'pending')->with(['user:user_id,user_name,user_lastname', 'subject:subject_id,subject_name', 'commission:commission_id,commission_name'])->get();
            return response()->json($enrollments);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudieron obtener las inscripciones pendientes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function mySubjects(Request $request)
    {
        try {
            $user = $request->user();
            $userId = $user->user_id;

            $enrollments = Enrollments::where('user_id', $userId)
                ->where('enrollment_status', 'approved')
                ->with([
                    'subject:subject_id,subject_name',
                    'commission:commission_id,commission_name',
                ])
                ->get();

            // Formato simplificado para el front
            $subjects = $enrollments->map(function ($enrollment) {
                return [
                    'subject_id'      => $enrollment->subject->subject_id,
                    'subject_name'    => $enrollment->subject->subject_name,
                    'commission_id'   => $enrollment->commission->commission_id,
                    'commission_name' => $enrollment->commission->commission_name,
                ];
            });

            return response()->json($subjects->values());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'No se pudieron obtener las materias del estudiante',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
