<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $latestSensorData = SensorData::latest()->first();

        // Ganti dengan URL sebenarnya dari server Laravel Anda
        $controlSettingsResponse = Http::get('http://localhost/api/control');
        $controlSettings = $controlSettingsResponse->json();

        $heaterLogs = [
            // Fetch or define heater logs
        ];

        $lampLogs = [
            // Fetch or define lamp logs
        ];

        return view('dashboard.dashboard', compact('latestSensorData', 'controlSettings', 'heaterLogs', 'lampLogs'));
    }
}


