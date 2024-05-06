<?php

namespace App\Http\Controllers;

use App\Models\payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payrolls = payroll::all();

        $formattedData = $payrolls->map(function ($payroll) {
            return [
                'id' => $payroll->id,
                'risk' => $payroll->risk,
                'salary' => $payroll->salary,
                'worked_days' => $payroll->worked_days,
                'employee_id' => $payroll->id,
                'names' => $payroll->employee->names,
                'surname' => $payroll->employee->surname,
                'document' => $payroll->employee->document,
                'position' => $payroll->position->name
            ];
        });

        return Response()->json([
            'status' => true,
            'data' => $formattedData ?? [],
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_employee' => 'required',
            'id_position' => 'required',
            'risk' => 'required',
            'salary' => 'required',
            'worked_days' => 'required',
        ], [
            'id_employee.required' => 'El Item es obligatorio',
            'id_position.required' => 'El Item es obligatorio',
            'risk.required' => 'El Item es obligatorio',
            'salary.required' => 'El Item es obligatorio',
            'worked_days.required' => 'El Item es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $payroll = payroll::create([
            'id_employee' => $request->id_employee,
            'id_position' => $request->id_position,
            'risk' => $request->risk,
            'salary' => $request->salary,
            'worked_days' => $request->worked_days
        ]);

        return Response()->json([
            'status' => true,
            'data' => $payroll ?? [],
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
        $payroll = payroll::find($id);

        if (!$payroll) {
            return response()->json(['message' => 'Item no encontrada'], 404);
        }

        $formattedData =  [
                'id' => $payroll->id,
                'risk' => $payroll->risk,
                'salary' => $payroll->salary,
                'worked_days' => $payroll->worked_days,
                'employee_id' => $payroll->id,
                'names' => $payroll->employee->names,
                'surname' => $payroll->employee->surname,
                'document' => $payroll->employee->document,
                'position' => $payroll->position->name
            ];


        return response()->json([
            'status' => true,
            'data' => $formattedData
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $payroll = payroll::find($id);

        if (!$payroll) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'id_employee' => 'required',
            'id_position' => 'required',
            'risk' => 'required',
            'salary' => 'required',
            'worked_days' => 'required',
        ], [
            'id_employee.required' => 'El Item es obligatorio',
            'id_position.required' => 'El Item es obligatorio',
            'risk.required' => 'El Item es obligatorio',
            'salary.required' => 'El Item es obligatorio',
            'worked_days.required' => 'El Item es obligatorio',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $payroll->id_employee = $request->id_employee;
        $payroll->id_position = $request->id_position;
        $payroll->risk = $request->risk;
        $payroll->salary = $request->salary;
        $payroll->worked_days = $request->worked_days;
        $payroll->save();

        return response()->json([
            'status' => true,
            'data' => $payroll,
            'message' => 'Item actualizado exitosamente'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $payroll = payroll::find($id);

        if (!$payroll) {
            return response()->json(['message' => 'Item no encontrado'], 404);
        }

        $payroll->delete();

        return response()->json([
            'status' => true,
            'data' => $payroll,
            'message' => 'Item eliminado exitosamente'
        ], 200);
    }
}
