<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FunctionaryController;
use App\Http\Controllers\PositionController;
use App\HTTP\Controllers\PayrollController;
use App\HTTP\Controllers\EpsController;
use App\HTTP\Controllers\ArlController;
use App\HTTP\Controllers\CesantiasController;
use App\HTTP\Controllers\PensionesController;

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

Route::prefix('arl')->group(function () {
    Route::get('/', [ArlController::class, 'index']);
    Route::post('/create', [ArlController::class, 'create']);
    Route::get('/show/{id}', [ArlController::class, 'show']);
    Route::put('/update/{id}', [ArlController::class, 'update']);
    Route::put('/updateStatus/{id}', [ArlController::class, 'updateStatus']);
    Route::delete('/delete/{id}', [ArlController::class, 'destroy']);
});

Route::prefix('eps')->group(function () {
    Route::get('/', [EpsController::class, 'index']);
    Route::post('/create', [EpsController::class, 'create']);
    Route::get('/show/{id}', [EpsController::class, 'show']);
    Route::put('/update/{id}', [EpsController::class, 'update']);
    Route::put('/updateStatus/{id}', [EpsController::class, 'updateStatus']);
    Route::delete('/delete/{id}', [EpsController::class, 'destroy']);
});

Route::prefix('cesantias')->group(function () {
    Route::get('/', [CesantiasController::class, 'index']);
    Route::post('/create', [CesantiasController::class, 'create']);
    Route::get('/show/{id}', [CesantiasController::class, 'show']);
    Route::put('/update/{id}', [CesantiasController::class, 'update']);
    Route::delete('/delete/{id}', [CesantiasController::class, 'destroy']);
});

Route::prefix('pensiones')->group(function () {
    Route::get('/', [PensionesController::class, 'index']);
    Route::post('/create', [PensionesController::class, 'create']);
    Route::get('/show/{id}', [PensionesController::class, 'show']);
    Route::put('/update/{id}', [PensionesController::class, 'update']);
    Route::delete('/delete/{id}', [PensionesController::class, 'destroy']);
});

