<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function(){
    return response()->json(['message' => 'API has Run!!', 'version' => '1.0']);
});

Route::post('register', [App\Http\Controllers\AuthController::class,'registration']);
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('users', \App\Http\Controllers\UserController::class);
});
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store']);
Route::delete('/roles/{id}', [App\Http\Controllers\RoleController::class, 'destroy']);
Route::put('/roles/{id}', [App\Http\Controllers\RoleController::class, 'update']);
