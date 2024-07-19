<?php

namespace App\Http\Controllers;

use App\Models\functionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FunctionaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $functionary = functionary::all();

        return Response()->json([
            'status' => true,
            'data' => $functionary ?? [],
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
            'document' => 'required|unique:functionaries,document',
            'id_position' => 'required',
        ], [
            'names.required' => 'El Item es obligatorio',
            'surname.required' => 'El Item es obligatorio',
            'document.required' => 'El Item es obligatorio',
            'document.unique' => 'Usuario ya se encuentra creado',
            'id_position.required' => 'El Item es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $functionary = functionary::create([
            'names' => $request->names,
            'surname' => $request->surname,
            'document' => $request->document,
            'id_position' => $request->id_position
        ]);

        return Response()->json([
            'status' => true,
            'data' => $functionary ?? [],
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
        $functionary = functionary::find($id);

        if (!$functionary) {
            return response()->json(['message' => 'Item no encontrada'], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $functionary
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(functionary $functionary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $functionary = functionary::find($id);

        if (!$functionary) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'names' => 'required',
            'surname' => 'required',
            'document' => 'required|unique:functionaries,document',
            'id_position' => 'required',
        ], [
            'names.required' => 'El Item es obligatorio',
            'surname.required' => 'El Item es obligatorio',
            'document.unique' => 'Usuario ya se encuentra creado',
            'id_position.required' => 'El Item es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $functionary->names = $request->names;
        $functionary->surname = $request->surname;
        $functionary->document = $request->document;
        $functionary->id_position = $request->id_position;
        $functionary->save();

        return response()->json([
            'status' => true,
            'data' => $functionary,
            'message' => 'Item actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $functionary = functionary::find($id);

        if (!$functionary) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        $functionary->delete();

        return response()->json([
            'status' => true,
            'data' => $functionary,
            'message' => 'Item eliminado exitosamente'
        ], 200);
    }
}
