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
            'nombre.required' => 'El campo cesantias es obligatorio',
            'nombre.unique' => 'El campo cesantias ya se encuentra registrado'
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
            'message' => 'Cesantias Creado exitosamente'
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
            return response()->json(['message' => 'Cesantias no encontrada'], 404);
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
            return response()->json(['message' => 'Cesantias no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo Cesantias es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $cesantias->nombre = $request->nombre;
        $cesantias->save();

        return response()->json([
            'status' => true,
            'data' => $cesantias,
            'message' => 'Cesantias actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cesantias = cesantias::find($id);

        if (!$cesantias) {
            return response()->json(['message' => 'Cesantias no encontrado'], 404);
        }

        $cesantias->delete();

        return response()->json([
            'status' => true,
            'data' => $cesantias,
            'message' => 'Cesantias eliminado exitosamente'
        ], 200);
    }

    public function updateStatus( $id ) {
        $cesantias = cesantias::find( $id );

        if ( !$cesantias ) {
            return response()->json( [ 'message' => 'Cesantias no encontrado' ], 404 );
        }

        if ( $cesantias->status == 1 ) {
            $cesantias->update( [ 'status' => 2 ] );
        } else {
            $cesantias->update( [ 'status' => 1 ] );
        }

        return response()->json( [
            'status' => true,
            'data' => $cesantias,
            'message' => 'Estado cesantias actualizado exitosamente',
        ], 200 );
    }
}
