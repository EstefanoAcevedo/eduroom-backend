<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AttendancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $attendance = Attendances::all();
            return response()->json($attendance);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudieron obtener los registros de asistencias',
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
                'attendance_date' => 'required',
                'attendance_is_justified' => 'required|boolean',
                'attendance_state_id' => 'required|int',
                'enrollment_id' => 'required|int'
            ]));
            $attendance = Attendances::create($request->all());
            return response()->json([
                'message' => 'Asistencia registrada exitosamente',
                'data' => $attendance,
            ], 201);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo registrar la asistencia, verifique la validez de los datos enviados',
                'error' => $e->validator->errors()
            ], 422);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo registrar la asistencia',
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
            $attendance = Attendances::findOrFail($id);
            return response()->json($attendance);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'El registro de asistencia solicitado no existe'
            ], 404);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo obtener el registro de asistencia',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendances $attendances)
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
                'attendance_date' => 'required',
                'attendance_is_justified' => 'required|boolean',
                'attendance_state_id' => 'required|int',
                'enrollment_id' => 'required|int'
            ]));
            $attendance = Attendances::findOrFail($id);
            $attendance->update($request->all());
            return response()->json([
                'message' => 'Registro de asistencia actualizado exitosamente',
                'data' => $attendance
            ], 200);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo actualizar el registro de asistencia, verifique la validez de los datos enviados',
                'error' => $e->validator->errors()
            ], 422);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'El registro de asistencia solicitado no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo actualizar el registro de asistencia',
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
            $attendance = Attendances::findOrFail($id);
            $attendance->delete();
            return response()->json([
                'message' => 'Registro de asistencia eliminado exitosamente',
                'data' => $attendance
            ], 200);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'El registro de asistencia solicitado no existe'
            ], 404);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo eliminar el registro de asistencia',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
