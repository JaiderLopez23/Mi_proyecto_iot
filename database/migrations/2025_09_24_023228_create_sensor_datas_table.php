<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sensor_datas', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('id_sensor');
            $t->float('value');
            $t->float('temperature');
            $t->float('humidity');
            $t->boolean('status')->default(true);
            $t->timestamp('deleted_at')->nullable();
            $t->timestamps();

            // Clave foránea opcional
            $t->foreign('id_sensor')->references('id')->on('sensors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_datas');
    }
};
