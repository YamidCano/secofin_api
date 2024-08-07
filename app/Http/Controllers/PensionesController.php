<?php

namespace App\Http\Controllers;

use App\Models\pensiones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PensionesController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $pensiones = pensiones::all();

        return Response()->json( [
            'status' => true,
            'data' => $pensiones ?? [],
        ], 200 );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create( Request $request ) {
        $validator = Validator::make( $request->all(), [
            'nombre' => 'required|unique:pensiones,nombre'
        ], [
            'nombre.required' => 'El campo pensiones es obligatorio',
            'nombre.unique' => 'El campo pensiones ya se encuentra registrado'
        ] );

        if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ], 422 );
        }

        $pensiones = pensiones::create( [
            'nombre' => $request->nombre,
            'status' => 1,
        ] );

        return response()->json( [
            'status' => true,
            'data' => $pensiones ?? [],
            'message' => 'Pensiones Creado exitosamente'
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
        $pensiones = pensiones::find( $id );

        if ( !$pensiones ) {
            return response()->json( [ 'message' => 'Pensiones no encontrada' ], 404 );
        }
        return response()->json( [
            'status' => true,
            'data' => $pensiones
        ], 200 );
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( pensiones $pensiones ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, $id ) {
        $pensiones = pensiones::find( $id );

        if ( !$pensiones ) {
            return response()->json( [ 'message' => 'Pensiones no encontrado' ], 404 );
        }

        $validator = Validator::make( $request->all(), [
            'nombre' => 'required',
        ], [
            'nombre.required' => 'El campo pensiones es obligatorio',
        ] );

        if ( $validator->fails() ) {
            return response()->json( [ 'errors' => $validator->errors() ], 422 );
        }

        $pensiones->nombre = $request->nombre;
        $pensiones->save();

        return response()->json( [
            'status' => true,
            'data' => $pensiones,
            'message' => 'Pensiones actualizado exitosamente'
        ], 200 );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( $id ) {
        $pensiones = pensiones::find( $id );

        if ( !$pensiones ) {
            return response()->json( [ 'message' => 'Pensiones no encontrado' ], 404 );
        }

        $pensiones->delete();

        return response()->json( [
            'status' => true,
            'data' => $pensiones,
            'message' => 'Pensiones eliminado exitosamente'
        ], 200 );
    }

    public function updateStatus( $id ) {
        $pensiones = pensiones::find( $id );

        if ( !$pensiones ) {
            return response()->json( [ 'message' => 'Pensiones no encontrado' ], 404 );
        }

        if ( $pensiones->status == 1 ) {
            $pensiones->update( [ 'status' => 2 ] );
        } else {
            $pensiones->update( [ 'status' => 1 ] );
        }

        return response()->json( [
            'status' => true,
            'data' => $pensiones,
            'message' => 'Estado pensiones actualizado exitosamente',
        ], 200 );
    }
}

