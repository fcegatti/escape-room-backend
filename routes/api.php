<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//all
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//admin and super_admin 
Route::middleware('role:admin,super_admin') -> group(function(){
    Route::get('users', [UserController::class, 'index']);
    // Route::get('users', [UserController::class, 'index']);
});

//only super admin
Route::middleware('role:super_admin') -> group(function(){
});
Route::post('register_admin', [AuthController::class, 'register_admin']);