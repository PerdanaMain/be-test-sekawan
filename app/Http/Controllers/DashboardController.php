<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\log;
use App\Models\Maintenance;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    // For the dashboard page
    public function index()
    {
        // get all logs
        $logs = Log::all();
        // get all vehicles

        $vehicles = Vehicle::all();

        // get all drivers
        $drivers = Driver::all();

        // get all maintenance cost
        $maintenances = Maintenance::all()->sum('maintenance_cost');

        return view('pages.dashboard', compact('logs', 'vehicles', 'drivers', 'maintenances'));
    }
}