<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::post('/create', [EmployeeController::class, 'create']);
    Route::get('/show/{id}', [EmployeeController::class, 'show']);
    Route::put('/update/{id}', [EmployeeController::class, 'update']);
    Route::delete('/delete/{id}', [EmployeeController::class, 'destroy']);
});
