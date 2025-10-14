<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseGeoSeeder extends Seeder
{
    public function run(): void
    {
        // País
        $countryId = DB::table('countries')->insertGetId([
            'name' => 'Colombia',
            'code' => 'CO',
            'abbrev' => 'COL',
            'status' => 1,
        ]);

        // Departamento
        $deptId = DB::table('departments')->insertGetId([
            'name' => 'Nariño',
            'code' => '52',
            'abbrev' => 'NAR',
            'status' => 1,
            'id_country' => $countryId,
        ]);

        // Ciudad
        DB::table('cities')->insert([
            'name' => 'Pasto',
            'code' => '52001',
            'abbrev' => 'PAS',
            'status' => 1,
            'id_department' => $deptId,
        ]);
    }
}
