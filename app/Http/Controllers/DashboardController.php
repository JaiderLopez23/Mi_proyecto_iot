<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = SensorData::latest()->take(10)->get();
        return view('dashboard', compact('data'));
    }
}
