<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Station;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::with('station')->get();
        return view('sensors.index', compact('sensors'));
    }

    public function create()
    {
        $stations = Station::all();
        return view('sensors.create', compact('stations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_station' => 'required|exists:stations,id',
        ]);

        Sensor::create($request->all());
        return redirect()->route('sensors.index')->with('success', 'Sensor creado correctamente');
    }
}
