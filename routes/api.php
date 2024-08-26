<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Log\LogController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Truck\TruckController;
use App\Http\Controllers\Driver\DriverController;
use Illuminate\Support\Facades\Route;


Route::post('/auth/login', [AuthController::class, 'login']);


    
Route::middleware('auth:api')->group(function () {
    
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/checkToken', [AuthController::class, 'checkToken']);
    Route::get('/auth/refresh', [AuthController::class, 'refresh']);
    Route::get('/auth/profile', [AuthController::class, 'profile']);
    Route::put('/auth/update/{id}', [AuthController::class, 'update']);
    
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);


    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles/{id}', [RoleController::class, 'show']);
    Route::put('/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

    Route::get('/permissions', [PermissionController::class, 'index']);
    
    Route::get('/logs', [LogController::class, 'index']);

});
