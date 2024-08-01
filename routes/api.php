<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FunctionaryController;
use App\Http\Controllers\PositionController;

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

Route::prefix('arl')->group(function () {
    Route::get('/', 'App\Http\Controllers\PayrollController@index');
    Route::post('/create', 'App\Http\Controllers\PayrollController@create');
    Route::get('/show/{id}', 'App\Http\Controllers\PayrollController@show');
    Route::put('/update/{id}', 'App\Http\Controllers\PayrollController@update');
    Route::put('/updateStatus/{id}', 'App\Http\Controllers\PayrollController@updateStatus');
    Route::delete('/delete/{id}', 'App\Http\Controllers\PayrollController@destroy');
});

Route::prefix('arl')->group(function () {
    Route::get('/', 'App\Http\Controllers\ArlController@index');
    Route::post('/create', 'App\Http\Controllers\ArlController@create');
    Route::get('/show/{id}', 'App\Http\Controllers\ArlController@show');
    Route::put('/update/{id}', 'App\Http\Controllers\ArlController@update');
    Route::put('/updateStatus/{id}', 'App\Http\Controllers\ArlController@updateStatus');
    Route::delete('/delete/{id}', 'App\Http\Controllers\ArlController@destroy');
});

Route::prefix('eps')->group(function () {
    Route::get('/', 'App\Http\Controllers\EpsController@index');
    Route::post('/create', 'App\Http\Controllers\EpsController@create');
    Route::get('/show/{id}', 'App\Http\Controllers\EpsController@show');
    Route::put('/update/{id}', 'App\Http\Controllers\EpsController@update');
    Route::put('/updateStatus/{id}', 'App\Http\Controllers\EpsController@updateStatus');
    Route::delete('/delete/{id}', 'App\Http\Controllers\EpsController@destroy');
});


