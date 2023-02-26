<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\EscapeController;
use App\Http\Controllers\RoomController;


Route::apiResource('problem', ProblemController::class);

//public
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('jwt.verify')->group(function () {
    Route::put('users/participed/{user}', [UserController::class, 'update']);
    
});

//only super admin
Route::middleware('role:super_admin')->group(function () {
    Route::post('register_admin', [AuthController::class, 'register_admin']);
});

//admin and super_admin 
Route::middleware('role:admin,super_admin')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::post('user/assign', [AuthController::class, 'create_aspirant_assign_room']);
    Route::delete('users/deleted/{user}', [UserController::class, 'destroy']);
    Route::apiResource('escape', EscapeController::class);
    Route::apiResource('rooms', RoomController::class);
});
