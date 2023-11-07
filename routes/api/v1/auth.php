<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

/**
 * Private Routes
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::post('verify-password', [AuthController::class, 'verifyPassword']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::get('logout', [AuthController::class, 'logout']);
});

/**
 * Public Routes
 */
Route::post('login', [AuthController::class, 'login']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('reset-password', [AuthController::class, 'resetPassword']);


/**
 * Fallback for not registered routes
 */
Route::fallback(function () {
    return response()->json(['message' => 'Not found'], 404);
});
