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
            'names' => 'required',
            'surname' => 'required',
            'document' => 'required',
        ], [
            'names.required' => 'El Item es obligatorio',
            'surname.required' => 'El Item es obligatorio',
            'document.required' => 'El Item es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employee = employee::create([
            'names' => $request->names,
            'surname' => $request->surname,
            'document' => $request->document
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
            'names' => 'required',
            'surname' => 'required',
            'document' => 'required',
        ], [
            'names.required' => 'El Item es obligatorio',
            'surname.required' => 'El Item es obligatorio',
            'document.required' => 'El Item es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employee->names = $request->names;
        $employee->surname = $request->surname;
        $employee->document = $request->document;
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
