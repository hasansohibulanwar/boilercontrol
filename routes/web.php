<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\HeaterController;
use App\Http\Controllers\LampController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [loginController::class, 'login'])->name('login.store');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/register', [registerController::class, 'index'])->name('register');
Route::post('/register', [registerController::class, 'store'])->name('register.store');

// Heater routes
Route::middleware('auth')->group(function () {
    Route::get('/heater', [HeaterController::class, 'index'])->name('heater.index');
    Route::post('/api/heater/store', [HeaterController::class, 'store'])->name('api.heater.store');
    Route::get('/api/control', [HeaterController::class, 'control'])->name('api.control');
});

// Lamp routes
Route::get('/lamp', [LampController::class, 'index'])->name('lamp.index');

// User routes
Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Device routes
    Route::get('/device', [DeviceController::class, 'index'])->name('device.index');
    Route::get('/device/create', [DeviceController::class, 'create'])->name('device.create');
    Route::post('/device', [DeviceController::class, 'store'])->name('device.store');
    Route::get('/device/{id}/edit', [DeviceController::class, 'edit'])->name('device.edit');
    Route::put('/device/{id}', [DeviceController::class, 'update'])->name('device.update');
    Route::delete('/device/{id}', [DeviceController::class, 'destroy'])->name('device.destroy');
});
