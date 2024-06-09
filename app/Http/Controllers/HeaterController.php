<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ControlSetting; // Make sure you have a model for your control settings

class HeaterController extends Controller
{
    public function index()
    {
        return view('dashboard.heater');
    }

    public function store(Request $request)
    {
        $mode = $request->input('mode');
        $heaterStatus = $request->input('heaterStatus') === 'on' ? 'on' : 'off';
        $maxTemp = $request->input('max_temp');
        $minTemp = $request->input('min_temp');

        // Validate the request data
        $validatedData = $request->validate([
            'mode' => 'required|string',
            'heaterStatus' => 'nullable|string',
            'max_temp' => 'nullable|numeric',
            'min_temp' => 'nullable|numeric',
        ]);

        // Save the data to the database
        ControlSetting::updateOrCreate(
            ['name' => 'heater'],
            ['value' => json_encode($validatedData)]
        );

        // Optionally, save data to the session
        session([
            'mode' => $mode,
            'heaterStatus' => $heaterStatus,
            'maxTemp' => $maxTemp,
            'minTemp' => $minTemp
        ]);

        // Send status to ESP
        $this->sendStatusToESP($heaterStatus);

        return response()->json([
            'status' => 'success',
            'message' => 'Heater configuration saved successfully'
        ]);
    }

    private function sendStatusToESP($status)
    {
        $url = 'http://192.168.1.10:8000/api/control'; // Adjust with your ESP endpoint URL
        $data = ['heaterStatus' => $status];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ],
        ];
        $context = stream_context_create($options);
        file_get_contents($url, false, $context);
    }

    public function control()
    {
        $heaterStatus = session('heaterStatus', false);
        $lampStatus = false; // Set the lamp status as needed

        return response()->json([
            'heaterStatus' => $heaterStatus ? 'on' : 'off',
            'lampStatus' => $lampStatus ? 'off' : 'off' // Adjust with your lamp status
        ]);
    }
}
