<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\City;
use Illuminate\Http\Request;

class StationController extends Controller
{

    public function index()
    {
        $stations = Station::with('city')->get();
        return view('stations.index', compact('stations'));
    }


    public function create()
    {
        $cities = City::all();
        return view('stations.create', compact('cities'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id_city' => 'required|exists:cities,id',
        ]);

        Station::create($request->all());
        return redirect()->route('stations.index')->with('success', 'Estación creada correctamente');
    }
}
