<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('company', CompanyController::class);
    Route::prefix('company')->controller(CompanyController::class)->group(function (){
        Route::put('restore/{id}', 'restore');
        Route::delete('force-delete/{id}', 'forceDelete');
    });

    Route::apiResource('employee', EmployeeController::class);
    Route::prefix('employee')->controller(EmployeeController::class)->group(function (){
        Route::put('restore/{id}', 'restore');
        Route::delete('force-delete/{id}', 'forceDelete');
    });

    Route::apiResource('client', ClientController::class);
    Route::prefix('client')->controller(ClientController::class)->group(function (){
        Route::put('restore/{id}', 'restore');
        Route::delete('force-delete/{id}', 'forceDelete');
    });

//});
/**
 * Fallback for not registered routes
 */
Route::fallback(function () {
    return response()->json(['message' => 'Not found'], 404);
});
