<?php

namespace App\Http\Controllers;

use App\Models\Commissions;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $commissions = Commissions::all();
            return response()->json($commissions);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudieron obtener las comisiones',
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
                'commission_name' => 'required|string|max:20|unique:commissions,commission_name'
            ]));
            $commission = Commissions::create($request->all());
            return response()->json([
                'message' => 'Comisión creada exitosamente',
                'data' => $commission,
            ], 201);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo crear la comisión, verifique la validez de los datos enviados',
                'error' => $e->validator->errors()
            ], 422);
        
        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo crear la comisión',
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
            $commission = Commissions::findOrFail($id);
            return response()->json($commission);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'La comisión solicitada no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo obtener la comisión',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commissions $commissions)
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
                'commission_name' => 'required|string|max:20|unique:commissions,commission_name'
            ]));
            $commission = Commissions::findOrFail($id);
            $commission->update($request->all());
            return response()->json([
                'message' => 'Comisión actualizada exitosamente',
                'data' => $commission,
            ], 201);
        
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'No se pudo actualizar la comisión, verifique la validez de los datos enviados',
                'error' => $e->validator->errors()
            ], 422);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'La comisión solicitada no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo actualizar la comisión',
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
            $commission = Commissions::findOrFail($id);
            $commission->delete();
            return response()->json([
                'message' => 'Comisión eliminada exitosamente',
                'data' => $commission,
            ], 201);
        
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'La comisión solicitada no existe'
            ], 404);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'No se pudo eliminar la comisión',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
