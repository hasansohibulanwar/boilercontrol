<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ControlController extends Controller
{
    public function getControlSettings()
    {
        $controlSettings = [
            'heater' => Cache::get('heater_control', ['heaterStatus' => 'OFF']),
            'lamp' => Cache::get('lamp_control', ['mode' => 'OFF']),
        ];

        return response()->json($controlSettings);
    }
}
