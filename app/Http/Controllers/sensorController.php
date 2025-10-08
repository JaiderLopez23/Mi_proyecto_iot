<?php

namespace App\Http\Controllers;

use App\Models\sensor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\department;


class sensorController extends Controller
{
    public function index()
    {
        $sensors = sensor::with('department.country')->paginate(10);
        return view('sensors.index', compact('sensors'));
    }

    public function create()
    {
        $departments = department::orderBy('name')->get();
        return view('sensors.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required',
            'code'          => 'required|unique:sensors,code',
            'abbrev'        => 'nullable',
            'id_department' => 'required|exists:departments,id',
            'status'        => 'nullable'
        ]);

        sensor::create([
            'name'          => $data['name'],
            'code'          => $data['code'],
            'abbrev'        => $data['abbrev'] ?? null,
            'id_department' => $data['id_department'],
            'status'        => $request->boolean('status'),
        ]);

        return redirect()->route('sensors.index')->with('ok', 'Sensor creado');
    }}