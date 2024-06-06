<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('dashboard.device', compact('devices'));
    }

    public function create()
    {
        return view('dashboard.createDevice');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // Create a new device
        Device::create($validatedData);

        return redirect()->route('device.index')->with('success', 'Device created successfully');
    }

    public function edit($id)
    {
        $device = Device::findOrFail($id);
        return view('dashboard.editDevice', compact('device'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // Find the device and update it
        $device = Device::findOrFail($id);
        $device->update($validatedData);

        return redirect()->route('device.index')->with('success', 'Device updated successfully');
    }

    public function destroy($id)
    {
        $device = Device::findOrFail($id);
        $device->delete();

        return redirect()->route('device.index')->with('success', 'Device deleted successfully');
    }
}
