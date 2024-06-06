<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HeaterController extends Controller
{
    public function index()
    {
        return view('dashboard.heater');
    }
}
