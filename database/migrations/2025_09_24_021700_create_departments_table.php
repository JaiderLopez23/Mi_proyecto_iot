<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('code')->nullable();
            $t->string('abbrev', 10)->nullable();
            $t->boolean('status')->default(true);

            // Relación con countries (ya corregida)
            $t->foreignId('id_country')
                ->constrained('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $t->timestamps();
            $t->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
