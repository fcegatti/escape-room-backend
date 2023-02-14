<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\EscapeController;


Route::apiResource('problem', ProblemController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('users', [UserController::class, 'index']);

//protected

Route::middleware('jwt.verify') -> group(function(){
    Route::apiResource('users', UserController::class);
});


Route::post('escape', [EscapeController::class, 'store']);
Route::get('escape', [EscapeController::class, 'index']);
Route::apiResource('escape', EscapeController::class);
// ruta para todos los metodos 