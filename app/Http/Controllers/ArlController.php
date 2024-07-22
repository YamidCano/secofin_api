<?php

namespace App\Http\Controllers;

use App\Models\arl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arl = arl::all();

        return Response()->json([
            'status' => true,
            'data' => $arl ?? [],
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required'
        ], [
            'nombre.required' => 'El Item es obligatorio'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $arl = arl::create([
            'nombre' => $request->nombre,
            'status' => 1,
        ]);

        return Response()->json([
            'status' => true,
            'data' => $arl ?? [],
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
        $arl = arl::find($id);

        if (!$arl) {
            return response()->json(['message' => 'Item no encontrada'], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $arl
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(arl $arl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $arl = arl::find($id);

        if (!$arl) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El Item es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $arl->nombre = $request->nombre;
        $arl->save();

        return response()->json([
            'status' => true,
            'data' => $arl,
            'message' => 'Item actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $arl = arl::find($id);

        if (!$arl) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        // $arl->delete();
        $arl->update(['status' => 2]);

        return response()->json([
            'status' => true,
            'data' => $arl,
            'message' => 'Item eliminado exitosamente'
        ], 200);
    }
}
