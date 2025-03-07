
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\AdditionalController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\HasApiTokens;
Route::prefix('v1')->group(function () {
    // Authentication routes
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        // User routes
        Route::apiResource('users', UserController::class);

        // Laptop routes
        Route::apiResource('laptops', LaptopController::class);

        // Additional routes
        Route::apiResource('additionals', AdditionalController::class);
    });
});
