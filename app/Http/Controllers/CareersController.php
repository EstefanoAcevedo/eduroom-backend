<?php

namespace App\Http\Controllers;

use App\Models\Careers;
use Illuminate\Http\Request;

class CareersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $careers = Careers::all();
        return response()->json($careers);
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
        $career = Careers::create($request->all());
        return response()->json($career, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Careers $careers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Careers $careers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $career = Careers::find($id);
        $career->update($request->all());
        return response()->json($career, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $career = Careers::find($id);
        $career->delete();
        return response()->json($career, 200);
    }

    public function showWithSubjects()
    {
        return Careers::with('subjects')->get();
    }
}
