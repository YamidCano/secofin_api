<?php

namespace App\Http\Controllers;

use App\Models\eps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EpsController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $eps = eps::all();

        return Response()->json( [
            'status' => true,
            'data' => $eps ?? [],
        ], 200 );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create( Request $request ) {
        $validator = Validator::make( $request->all(), [
            'nombre' => 'required|unique:eps,nombre'
        ], [
            'name.required' => 'El EPS es obligatorio',
            'nombre.unique' => 'El EPS ya se encuentra registrado'
        ] );

        if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ], 422 );
        }

        $eps = eps::create( [
            'nombre' => $request->nombre,
            'status' => 1,
        ] );

        return response()->json( [
            'status' => true,
            'data' => $eps ?? [],
            'message' => 'EPS Creado exitosamente'
        ], 200 );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        //
    }

    /**
    * Display the specified resource.
    */

    public function show( $id ) {
        $eps = eps::find( $id );

        if ( !$eps ) {
            return response()->json( [ 'message' => 'eps no encontrada' ], 404 );
        }
        return response()->json( [
            'status' => true,
            'data' => $eps
        ], 200 );
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( eps $eps ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, $id ) {
        $eps = eps::find( $id );

        if ( !$eps ) {
            return response()->json( [ 'message' => 'eps no encontrado' ], 404 );
        }

        $validator = Validator::make( $request->all(), [
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El eps es obligatorio',
        ] );

        if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ], 422 );
        }

        $eps->nombre = $request->nombre;
        $eps->save();

        return response()->json( [
            'status' => true,
            'data' => $eps,
            'message' => 'EPS actualizado exitosamente'
        ], 200 );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( $id ) {
        $eps = eps::find( $id );

        if ( !$eps ) {
            return response()->json( [ 'message' => 'EPS no encontrado' ], 404 );
        }

        $eps->delete();

        return response()->json( [
            'status' => true,
            'data' => $eps,
            'message' => 'EPS eliminado exitosamente'
        ], 200 );
    }

    public function updateStatus( $id ) {
        $eps = eps::find( $id );

        if ( !$eps ) {
            return response()->json( [ 'message' => 'EPS no encontrado' ], 404 );
        }

        if ( $eps->status == 1 ) {
            $eps->update( [ 'status' => 2 ] );
        } else {
            $eps->update( [ 'status' => 1 ] );
        }

        return response()->json( [
            'status' => true,
            'data' => $eps,
            'message' => 'Estado EPS actualizado exitosamente',
        ], 200 );
    }
}
