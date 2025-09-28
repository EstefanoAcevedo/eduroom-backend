<?php

namespace App\Http\Controllers;

use App\Models\Careers;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CareersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $careers = Careers::all();
            return response()->json($careers);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudieron obtener las carreras',
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
                'career_name' => 'required|string|max:255|unique:careers,career_name',
                'career_alias' => 'required|string|max:10|unique:careers,career_alias',
            ]));
            $career = Careers::create($request->all());
            return response()->json([
                'message' => 'Carrera creada exitosamente',
                'data' => $career,
            ], 201);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo crear la carrera, verifique la validez de los datos enviados',
                'error' => $e->validator->errors()
            ], 422);
        
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'No se pudo crear la carrera',
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
            $career = Careers::findOrFail($id);
            return response()->json($career);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'La carrera solicitada no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo obtener la carrera',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Careers $careers)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate(([
                'career_name' => 'required|string|max:255',
                'career_alias' => 'required|string|max:10',
            ]));
            $career = Careers::findOrFail($id);
            $career->update($request->all());
            return response()->json([
                'message' => 'Carrera actualizada exitosamente',
                'data' => $career
            ], 200);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo actualizar la carrera, verifique la validez de los datos',
                'error' => $e->validator->errors()
            ], 422);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'La carrera solicitada no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo actualizar la carrera',
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
            $career = Careers::findOrFail($id);
            $career->delete();
            return response()->json([
                'message' => 'Carrera eliminada exitosamente',
                'data' => $career
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'La carrera solicitada no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo eliminar la carrera',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /** 
     * Show the list of careers and their subjects
     */
    public function showWithSubjects()
    {
        try {
            return Careers::with('subjects')->get();
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudieron obtener las carreras y asignaturas',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
