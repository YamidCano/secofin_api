<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = employee::all();

        return Response()->json([
            'status' => true,
            'data' => $employee ?? [],
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'document_type' => 'required|unique:document_types',
        ], [
            'document_type.required' => 'El Item es obligatorio',
            'document_type.unique' => 'El Item ya se encuentra registrado'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employee = employee::create([
            'name' => $request->name
        ]);

        return Response()->json([
            'status' => true,
            'data' => $employee ?? [],
            'message' => 'Item Creado exitosamente'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Item no encontrada'], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $employee
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:document_types,name,' . $id,
        ], [
            'name.required' => 'El Item es obligatorio',
            'name.unique' => 'El Item ya se encuentra registrado'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employee->name = $request->name;
        $employee->save();

        return response()->json([
            'status' => true,
            'data' => $employee,
            'message' => 'Item actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        $employee->delete();

        return response()->json([
            'status' => true,
            'data' => $employee,
            'message' => 'Item eliminado exitosamente'
        ], 200);
    }
}
