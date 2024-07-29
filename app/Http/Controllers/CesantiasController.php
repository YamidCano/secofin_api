<?php

namespace App\Http\Controllers;

use App\Models\cesantias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CesantiasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cesantias = cesantias::all();

        return Response()->json([
            'status' => true,
            'data' => $cesantias ?? [],
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:cesantias,nombre'
        ], [
            'name.required' => 'El cesantias es obligatorio',
            'nombre.unique' => 'El cesantias ya se encuentra registrado'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cesantias = cesantias::create([
            'nombre' => $request->nombre,
            'status' => 1,
        ]);

        return response()->json([
            'status' => true,
            'data' => $cesantias ?? [],
            'message' => 'cesantias Creado exitosamente'
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
        $cesantias = cesantias::find($id);

        if (!$cesantias) {
            return response()->json(['message' => 'cesantias no encontrada'], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $cesantias
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cesantias $cesantias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cesantias = cesantias::find($id);

        if (!$cesantias) {
            return response()->json(['message' => 'cesantias no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El cesantias es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cesantias->nombre = $request->nombre;
        $cesantias->save();

        return response()->json([
            'status' => true,
            'data' => $cesantias,
            'message' => 'cesantias actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cesantias = cesantias::find($id);

        if (!$cesantias) {
            return response()->json(['message' => 'cesantias no encontrado'], 404);
        }

        // $cesantias->delete();
        $cesantias->update(['status' => 2]);

        return response()->json([
            'status' => true,
            'data' => $cesantias,
            'message' => 'cesantias eliminado exitosamente'
        ], 200);
    }
}
