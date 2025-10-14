<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataApiController;

// Endpoint que devuelve los datos para Chart.js
Route::get('/telemetry', [DataApiController::class, 'series']);
