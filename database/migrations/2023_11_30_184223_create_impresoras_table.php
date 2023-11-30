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
        Schema::create('impresoras', function (Blueprint $table) {
            $table->id();
            $table->string('proveedor')->nullable();
            $table->string('modelo')->nullable();
            $table->enum('tipo',['Propia','Alquilada'])->nullable();
            $table->string('serial')->nullable();
            $table->string('codigo')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('tipo_toner')->nullable();
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impresoras');
    }
};
