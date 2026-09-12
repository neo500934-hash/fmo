<?php

use App\Http\Controllers\DriverLocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/driver/location', [DriverLocationController::class, 'update']);
