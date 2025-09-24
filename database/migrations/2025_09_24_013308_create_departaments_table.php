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
        Schema::create('departaments', function (Blueprint $t) {
           $t->id(); // id autoincremental
            $t->string('name'); // nombre
            $t->string('code')->nullable(); 
            $t->string('abbrev')->nullable(); 
            $t->boolean('status')->default(true); 
            $t->unsignedBigInteger('id_country'); 
            $t->timestamps();
         
            // Opcional: Definir foreign key
            $t->foreign('id_country')
                  ->references('id')
                  ->on('countries')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departaments');
    }
};
