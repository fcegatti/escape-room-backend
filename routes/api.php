<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProblemController;

Route::apiResource('problem', ProblemController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('users', [UserController::class, 'index']);
Route::get('clue', [ClueController::class, 'index']);

//protected

Route::middleware('jwt.verify') -> group(function(){
    Route::apiResource('users', UserController::class);
});
