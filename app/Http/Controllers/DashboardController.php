<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request): View
    {
        if ($request->user()->isDriver()) {
            return view('dashboard-driver');
        }

        $onlineDrivers = Driver::online()->with('user')->latest('gps_updated_at')->get();

        return view('dashboard', compact('onlineDrivers'));
    }
}
