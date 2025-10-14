<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('stations', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('code')->nullable();
            $t->boolean('status')->default(true);
            $t->foreignId('id_city')->constrained('cities')->onDelete('cascade');
            $t->timestamps();
            $t->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('stations');
    }
};
