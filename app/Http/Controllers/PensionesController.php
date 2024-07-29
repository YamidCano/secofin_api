<?php

namespace App\Http\Controllers;

use App\Models\pensiones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PensionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pensiones = pensiones::all();

        return Response()->json([
            'status' => true,
            'data' => $pensiones ?? [],
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], [
            'name.required' => 'El Item es obligatorio'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pensiones = pensiones::create([
            'name' => $request->name,
            'status' => 1,
        ]);

        return Response()->json([
            'status' => true,
            'data' => $pensiones ?? [],
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
        $pensiones = pensiones::find($id);

        if (!$pensiones) {
            return response()->json(['message' => 'Item no encontrada'], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $pensiones
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pensiones $pensiones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pensiones = pensiones::find($id);

        if (!$pensiones) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'El Item es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pensiones->name = $request->name;
        $pensiones->save();

        return response()->json([
            'status' => true,
            'data' => $pensiones,
            'message' => 'Item actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pensiones = pensiones::find($id);

        if (!$pensiones) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        // $pensiones->delete();
        $pensiones->update(['status' => 2]);

        return response()->json([
            'status' => true,
            'data' => $pensiones,
            'message' => 'Item eliminado exitosamente'
        ], 200);
    }
}
