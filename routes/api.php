<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SensorDataController;
use App\Http\Controllers\ControlController;
use App\Http\Controllers\HeaterController;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\ApiController;

Route::post('/data', [ApiController::class, 'store']);
Route::get('/control', [ApiController::class, 'getControlSettings']);

// Route::post('/sensor-data', [SensorDataController::class, 'store']);
// Route::get('/control', [SensorDataController::class, 'getControlSettings']);
// Route::post('/heater-control', [ControlController::class, 'heaterControl']);
// Route::post('/lamp-control', [ControlController::class, 'lampControl']);
Route::get('/control', function (Request $request) {
    // Contoh data yang dikirim
    return response()->json([
        'heater' => true,  // Atau nilai yang dinamis berdasarkan kondisi
        'lamp' => false,   // Atau nilai yang dinamis berdasarkan kondisi
    ]);
});

Route::post('/data', function (Request $request) {
    $data = $request->all();
    // Lakukan sesuatu dengan data, misalnya simpan ke database
    return response()->json(['message' => 'Data received successfully']);
});




Route::post('/heater-control', [HeaterController::class, 'store'])->name('api.heater.store');
Route::get('/heater-control', [HeaterController::class, 'control'])->name('api.heater.control');
