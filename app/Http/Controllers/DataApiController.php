<?php

namespace App\Http\Controllers;

use App\Models\SensorData;
use Illuminate\Http\Request;

class DataApiController extends Controller
{
    /**
     * Retorna datos de telemetría para el gráfico del dashboard.
     */
    public function series()
    {
        $data = SensorData::select('created_at', 'value', 'id_sensor')
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return response()->json($data);
    }
}
