<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\station;
use App\Models\sensor_data;
use App\Models\sensors;

class DashboardController extends Controller
{
    public function index()
    {
        // Métricas básicas
        $stations = station::with('city')->orderBy('name')->get();
        $sensorsOnline = sensors::where('status', true)->count();
        $lastSync = sensor_data::max('created_at');
        $dbDriver = strtoupper(config('database.default'));

        return view('dashboard', compact('stations','sensorsOnline','lastSync','dbDriver'));
    }}
