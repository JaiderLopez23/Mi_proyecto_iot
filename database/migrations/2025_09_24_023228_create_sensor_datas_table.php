<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sensor_data', function (Blueprint $t) {
            $t->id();
            $t->foreignId('id_sensor')->constrained('sensors')->onDelete('cascade');
            $t->foreignId('id_station')->constrained('stations')->onDelete('cascade');
            $t->float('temp_value')->nullable();
            $t->float('humidity')->nullable();
            $t->boolean('status')->default(true);
            
            $t->timestamps();
            $t->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};

