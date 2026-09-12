<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class DriverTrackingController extends Controller
{
    /**
     * Display the live driver tracking map.
     */
    public function index(): View
    {
        return view('drivers.tracking');
    }

    /**
     * Get the currently online drivers and their last known location, as JSON.
     */
    public function data(): JsonResponse
    {
        $drivers = Driver::online()->with('user')->get()->map(fn (Driver $driver) => [
            'id' => $driver->id,
            'name' => $driver->user->name,
            'phone' => $driver->phone,
            'car' => $driver->car,
            'color' => $driver->color,
            'status' => $driver->status,
            'lat' => (float) $driver->gps_lat,
            'lng' => (float) $driver->gps_lng,
            'updated_at' => $driver->gps_updated_at?->diffForHumans(),
        ]);

        return response()->json(['drivers' => $drivers]);
    }
}
