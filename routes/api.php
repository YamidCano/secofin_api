<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FunctionaryController;
use App\Http\Controllers\PositionController;
use App\HTTP\Controllers\PayrollController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::prefix('functionary')->group(function () {
    Route::get('/', [FunctionaryController::class, 'index']);
    Route::post('/create', [FunctionaryController::class, 'create']);
    Route::get('/show/{id}', [FunctionaryController::class, 'show']);
    Route::put('/update/{id}', [FunctionaryController::class, 'update']);
    Route::delete('/delete/{id}', [FunctionaryController::class, 'destroy']);
});

Route::prefix('position')->group(function () {
    Route::get('/', [PositionController::class, 'index']);
    Route::post('/create', [PositionController::class, 'create']);
    Route::get('/show/{id}', [PositionController::class, 'show']);
    Route::put('/update/{id}', [PositionController::class, 'update']);
    Route::delete('/delete/{id}', [PositionController::class, 'destroy']);
});

Route::prefix('payroll')->group(function () {
    Route::get('/', [PayrollController::class, 'index']);
    Route::post('/create', [PayrollController::class, 'create']);
    Route::get('/show/{id}', [PayrollController::class, 'show']);
    Route::put('/update/{id}', [PayrollController::class, 'update']);
    Route::delete('/delete/{id}', [PayrollController::class, 'destroy']);
});


