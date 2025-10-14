<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    ContactController,
    StationController,
    SensorController,
    DataApiController
};

// Ruta principal (dashboard)
Route::get('/', [DashboardController::class, 'index'])->name('home');

// CRUD básico
Route::resource('stations', StationController::class)->only(['index','create','store']);
Route::resource('sensors', SensorController::class)->only(['index','create','store']);

// API de telemetría
Route::get('/telemetry', [DataApiController::class, 'series'])->name('api.telemetry');

