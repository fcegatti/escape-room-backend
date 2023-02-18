<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\EscapeController;


Route::apiResource('problem', ProblemController::class);

//public
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('jwt.verify')->group(function () {
    Route::apiResource('escape', EscapeController::class);
    Route::update('users/participed/{user}', [UserController::class, 'update']);
    
});

//only super admin
Route::middleware('role:super_admin')->group(function () {
    Route::post('register_admin', [AuthController::class, 'register_admin']);
});

//admin and super_admin 
Route::middleware('role:admin,super_admin')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::delete('users/deleted/{user}', [UserController::class, 'destroy']);
});
