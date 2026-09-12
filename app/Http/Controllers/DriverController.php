<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DriverController extends Controller
{
    /**
     * Display a listing of the drivers.
     */
    public function index(): View
    {
        $drivers = Driver::with('user')->latest()->get();

        return view('drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new driver.
     */
    public function create(): View
    {
        $users = User::ranked()->whereDoesntHave('driver')->orderBy('name')->get();

        return view('drivers.create', compact('users'));
    }

    /**
     * Store a newly created driver in storage.
     */
    public function store(StoreDriverRequest $request): RedirectResponse
    {
        Driver::create($request->validated());

        return redirect()->route('drivers.index')->with('status', 'Driver created successfully.');
    }

    /**
     * Show the form for editing the specified driver.
     */
    public function edit(Driver $driver): View
    {
        $users = User::ranked()
            ->where(function ($query) use ($driver) {
                $query->whereDoesntHave('driver')->orWhere('id', $driver->user_id);
            })
            ->orderBy('name')
            ->get();

        return view('drivers.edit', compact('driver', 'users'));
    }

    /**
     * Update the specified driver in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver): RedirectResponse
    {
        $driver->update($request->validated());

        return redirect()->route('drivers.index')->with('status', 'Driver updated successfully.');
    }

    /**
     * Remove the specified driver from storage.
     */
    public function destroy(Driver $driver): RedirectResponse
    {
        $driver->delete();

        return redirect()->route('drivers.index')->with('status', 'Driver deleted successfully.');
    }
}
