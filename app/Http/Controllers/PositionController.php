<?php

namespace App\Http\Controllers;

use App\Models\position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $position = position::all();

        return Response()->json([
            'status' => true,
            'data' => $position ?? [],
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'El Item es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $position = position::create([
            'name' => $request->name,
        ]);

        return Response()->json([
            'status' => true,
            'data' => $position ?? [],
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
        $position = position::find($id);

        if (!$position) {
            return response()->json(['message' => 'Item no encontrada'], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $position
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $position = position::find($id);

        if (!$position) {
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

        $position->name = $request->name;
        $position->save();

        return response()->json([
            'status' => true,
            'data' => $position,
            'message' => 'Item actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $position = position::find($id);

        if (!$position) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        $position->delete();

        return response()->json([
            'status' => true,
            'data' => $position,
            'message' => 'Item eliminado exitosamente'
        ], 200);
    }
}
