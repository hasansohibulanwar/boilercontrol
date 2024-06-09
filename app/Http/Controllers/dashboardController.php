<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;
use App\Models\ActivityLog; // Import the ActivityLog model
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the latest sensor data from the database
        $latestSensorData = SensorData::latest()->first();

        // Fetch control settings from an external API
        $controlSettings = [];
        try {
            $response = Http::get('http://192.168.1.10:8000/api/control');
            if ($response->successful()) {
                $controlSettings = $response->json();
            } else {
                // Handle non-successful response
                // You can log the error or set a default value
                $controlSettings = ['heater' => false, 'lamp' => false]; // Example default values
            }
        } catch (\Exception $e) {
            // Handle the exception
            // You can log the error or set a default value
            $controlSettings = ['heater' => false, 'lamp' => false]; // Example default values
        }

        // Fetch the heater and lamp logs from the database
        $heaterLogs = ActivityLog::where('type', 'heater')->orderBy('created_at', 'desc')->limit(10)->get();
        $lampLogs = ActivityLog::where('type', 'lamp')->orderBy('created_at', 'desc')->limit(10)->get();

        // Return the view with the data
        return view('dashboard.dashboard', compact('latestSensorData', 'controlSettings', 'heaterLogs', 'lampLogs'));
    }
};

