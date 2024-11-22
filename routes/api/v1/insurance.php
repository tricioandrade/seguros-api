<?php

use App\Http\Controllers\Insurance\Claim\ClaimPhotosController;
use App\Http\Controllers\Insurance\ClaimsController;
use App\Http\Controllers\Insurance\InsuranceController;
use App\Http\Controllers\Insurance\PoliciesController;
use App\Http\Controllers\Insurance\Travel\TravelDestinationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('insurance', InsuranceController::class);
    Route::prefix('insurance')->controller(InsuranceController::class)->group(function (){
        Route::put('restore', 'restore');
        Route::delete('force-delete', 'forceDelete');
    });

    Route::apiResource('travel-destination', TravelDestinationController::class);
    Route::prefix('travel-destination')->controller(TravelDestinationController::class)->group(function (){
        Route::put('restore', 'restore');
        Route::delete('force-delete', 'forceDelete');
    });

    Route::apiResource('policy', PoliciesController::class)->except( 'destroy');
    Route::prefix('policy')->controller(PoliciesController::class)->group(function (){
        Route::put('restore', 'restore');
        Route::delete('force-delete', 'forceDelete');
    });

    Route::apiResource('claim', ClaimsController::class);
    Route::prefix('claim')->controller(ClaimsController::class)->group(function (){
        Route::put('restore', 'restore');
        Route::delete('force-delete', 'forceDelete');
    });

    Route::apiResource('claim-photos', ClaimPhotosController::class);
    Route::prefix('claim-photos')->controller(ClaimPhotosController::class)->group(function (){
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
