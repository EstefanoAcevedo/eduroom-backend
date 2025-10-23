<?php

namespace App\Http\Controllers;

use App\Models\AttendanceStates;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AttendanceStatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $attendanceStates = AttendanceStates::all();
            return response()->json($attendanceStates);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudieron obtener los estados de asistencia',
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
                'attendance_state_name' => 'required|string|max:20',
                'attendance_state_value' => 'required|numeric|between:0,9.99',
            ]));
            $attendanceState = AttendanceStates::create($request->all());
            return response()->json([
                'message' => 'Estado de asistencia creado exitosamente',
                'data' => $attendanceState,
            ], 201);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo crear el estado de asistencia, verifique la validez de los datos enviados',
                'error' => $e->validator->errors()
            ], 422);
        
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'No se pudo crear el estado de asistencia',
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
            $attendanceState = AttendanceStates::findOrFail($id);
            return response()->json($attendanceState);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'El estado de asistencia solicitado no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo obtener el estado de asistencia',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendanceStates $attendanceStates)
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
                'attendance_state_name' => 'required|string|max:20',
                'attendance_state_value' => 'required|numeric|between:0,9.99',
            ]));
            $attendanceState = AttendanceStates::findOrFail($id);
            $attendanceState->update($request->all());
            return response()->json([
                'message' => 'Estado de asistencia actualizado exitosamente',
                'data' => $attendanceState
            ], 200);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo actualizar el estado de asistencia, verifique la validez de los datos',
                'error' => $e->validator->errors()
            ], 422);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'El estado de asistencia solicitado no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo actualizar el estado de asistencia',
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
            $attendanceState = AttendanceStates::findOrFail($id);
            $attendanceState->delete();
            return response()->json([
                'message' => 'Estado de asistencia eliminado exitosamente',
                'data' => $attendanceState
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'El estado de asistencia solicitado no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo eliminar el estado de asistencia',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
