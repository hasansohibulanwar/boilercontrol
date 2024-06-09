<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;

class ApiController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'ldrValue' => 'required|numeric',
        ]);

        $sensorData = new SensorData();
        $sensorData->temperature = $validatedData['temperature'];
        $sensorData->humidity = $validatedData['humidity'];
        $sensorData->ldrValue = $validatedData['ldrValue'];
        $sensorData->save();

        return response()->json(['message' => 'Data stored successfully'], 200);
    }

    public function getControlSettings()
    {
        // Return some control settings as an example
        return response()->json([
            'heater' => false,
            'lamp' => true
        ]);
    }
}
