<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Define las rutas de la API para la autenticación
Route::prefix('auth')->middleware('api')->group(function(){
    Route::post('register',    [AuthController::class, 'register']);
    Route::post('login',       [AuthController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function(){
        Route::post('logout',     [AuthController::class,'logout']);
        Route::post('logout-all', [AuthController::class,'logoutAll']);
    });
    
    Route::post('email/confirm',[AuthController::class,'confirmEmail']);
    Route::post('password/otp', [AuthController::class,'sendResetOtp']);
    Route::post('password/reset',[AuthController::class,'resetPassword']);
});
