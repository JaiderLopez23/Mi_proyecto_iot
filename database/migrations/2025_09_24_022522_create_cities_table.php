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
        Schema::create('cities', function (Blueprint $t) {
             $t->id();
            $t->string('name');
             $t->id();
            $t->string('name');
            $t->string('code');
            $t->string('abbrev');
            $t->boolean('status')->default(true);
            $t->unsignedBigInteger('id_department');
            $t->timestamp('deleted_at')->nullable();
            $t->timestamps();

            // Clave foránea opcional
            $t->foreign('id_department')->references('id')->on('departments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
