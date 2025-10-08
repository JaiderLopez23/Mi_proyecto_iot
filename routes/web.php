<?php
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\{
    ContactController,
    StationController,
    SensorController
};
use App\Http\Controllers\DataApiController;
Route::get('/', [DashboardController::class, 'index'])->name('home'); // o 'dashboard'

Route::get('/', [DashboardController::class,'index'])->name('dashboard');
Route::resource('stations', stationController::class)->only(['index','create','store']);
Route::resource('sensors',  sensorController::class)->only(['index','create','store']);
Route::get('/telemetry', [DataApiController::class,'series'])->name('api.telemetry'); 