<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LampController extends Controller
{
    public function index()
    {
        return view('dashboard.lamp');
    }
}
