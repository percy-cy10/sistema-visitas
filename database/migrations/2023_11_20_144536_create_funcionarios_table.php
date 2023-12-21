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
        
        Schema::create('funcionario', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->nullable();
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('cargo');
            $table->unsignedBigInteger('oficina')->nullable();
            $table->foreign('oficina')->references('id')->on('oficinas')->onDelete('set null');

            $table->index(['id', 'nombre', 'apellido_paterno', 'apellido_materno']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionario');
    }
};
