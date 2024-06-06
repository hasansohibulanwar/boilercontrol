<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControlController extends Controller
{
    public function index()
    {
        return response()->json([
            'heater' => true, // Or dynamic value
            'lamp' => false   // Or dynamic value
        ], 200);
    }
}
