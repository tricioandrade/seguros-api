<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\Vehicle\VehicleController;
use App\Http\Controllers\Client\Vehicle\VehiclePhotosController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('client', ClientController::class)->except(['destroy', 'update']);
    Route::prefix('client')->controller(ClientController::class)->group(function (){
        Route::put('restore', 'restore');
        Route::delete('force-delete', 'forceDelete');
    });

    Route::apiResource('vehicle', VehicleController::class);
    Route::prefix('vehicle')->controller(VehicleController::class)->group(function (){
        Route::put('restore', 'restore');
        Route::delete('force-delete', 'forceDelete');
    });

    Route::apiResource('vehicle-photos', VehiclePhotosController::class);
    Route::prefix('vehicle-photos')->controller(VehiclePhotosController::class)->group(function (){
        Route::put('restore', 'restore');
        Route::delete('force-delete', 'forceDelete');
    });
});

/**
 * Fallback for not registered routes
 */
Route::fallback(function () {
    return response()->json(['message' => 'Not found'], 404);
});
