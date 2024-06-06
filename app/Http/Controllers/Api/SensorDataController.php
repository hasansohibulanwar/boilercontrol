<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SensorData;
use Illuminate\Support\Facades\Validator;

class SensorDataController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'ldrValue' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $sensorData = SensorData::create($request->all());

        return response()->json(['success' => true, 'data' => $sensorData], 201);
    }

    public function getControlSettings()
    {
        // Retrieve control settings from the database or any other source
        // For example purposes, returning hard-coded values
        return response()->json([
            'heater' => true,
            'lamp' => false
        ]);
    }
}
