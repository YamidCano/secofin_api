<?php

namespace App\Http\Controllers;

use App\Models\afp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AfpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $afp = afp::all();

        return Response()->json([
            'status' => true,
            'data' => $afp ?? [],
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:AFP,nombre',
            'nit' => 'required|unique:AFP,nit'
        ], [
            'nombre.required' => 'El campo Nombre AFP es obligatorio',
            'nombre.unique' => 'El campo Nombre AFP ya se encuentra registrado',
            'nit.required' => 'El campo Nit AFP es obligatorio',
            'nit.unique' => 'El campo Nit AFP ya se encuentra registrado',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $afp = afp::create([
            'nombre' => $request->nombre,
            'nit' => $request->nit,
            'status' => 1,
        ]);

        return response()->json([
            'status' => true,
            'data' => $afp ?? [],
            'message' => 'AFP Creado exitosamente'
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
        $afp = afp::find($id);

        if (!$afp) {
            return response()->json(['message' => 'AFP no encontrada'], 404);
        }
        return response()->json([
            'status' => true,
            'data' => $afp
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(afp $afp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $afp = afp::find($id);

        if (!$afp) {
            return response()->json(['message' => 'AFP no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:AFP,nombre,' . $id,
            'nit' => 'required|unique:AFP,nit,' . $id,
        ], [
            'nombre.required' => 'El campo Nombre AFP es obligatorio',
            'nombre.unique' => 'El campo Nombre AFP ya se encuentra registrado',
            'nit.required' => 'El campo Nit AFP es obligatorio',
            'nit.unique' => 'El campo Nit AFP ya se encuentra registrado',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $afp->nombre = $request->nombre;
        $afp->nit = $request->nit;
        $afp->save();

        return response()->json([
            'status' => true,
            'data' => $afp,
            'message' => 'AFP actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $afp = afp::find($id);

        if (!$afp) {
            return response()->json(['message' => 'AFP no encontrado'], 404);
        }

        $afp->delete();

        return response()->json([
            'status' => true,
            'data' => $afp,
            'message' => 'AFP eliminado exitosamente'
        ], 200);
    }

    public function updateStatus( $id ) {
        $afp = afp::find( $id );

        if ( !$afp ) {
            return response()->json( [ 'message' => 'AFP no encontrado' ], 404 );
        }

        if ( $afp->status == 1 ) {
            $afp->update( [ 'status' => 2 ] );
        } else {
            $afp->update( [ 'status' => 1 ] );
        }

        return response()->json( [
            'status' => true,
            'data' => $afp,
            'message' => 'Estado AFP actualizado exitosamente',
        ], 200 );
    }
}
