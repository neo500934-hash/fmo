<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverLocationController;
use App\Http\Controllers\DriverTrackingController;
use App\Http\Controllers\SmsWebhookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// routes/web.php
Route::get('/gps-test-send', function () {
    return view('gps-test-send');
});

Route::post('/sms/webhook', [SmsWebhookController::class, 'receive'])
    ->name('sms.webhook')
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::resource('drivers', DriverController::class)->except(['show']);
    Route::resource('users', UserController::class)->except(['show']);

    Route::get('/tracking', [DriverTrackingController::class, 'index'])->name('drivers.tracking');
    Route::get('/tracking/data', [DriverTrackingController::class, 'data'])->name('drivers.tracking.data');

    Route::post('/driver/location', [DriverLocationController::class, 'update'])->name('driver.location.update');

    // Add new routes here — everything in this group requires login.
});
