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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->string('dni', 8);
            $table->string('nombres');
            $table->string('apellidos');

            $table->string('empresa')->nullable();
            $table->string('motivo',100)->nullable();
            $table->string('cargo');

            $table->dateTime('fecha_y_hora');
            $table->dateTime('fecha_y_hora_salida')->nullable();
            $table->string('estado');
            $table->string('observaciones', 100)->nullable();
            
            $table->timestamps();
        });
        
        Schema::table('visitas', function (Blueprint $table) {
            $table->unsignedBigInteger('personero_id');
            $table->unsignedBigInteger('oficina_id');
            $table->unsignedBigInteger('funcionario_id')->nullable();

            
            $table->foreign('personero_id')->references('id')->on('users');
            $table->foreign('oficina_id')->references('id')->on('oficinas');
            $table->foreign('funcionario_id')->references('id')->on('funcionario')->onDelete('set null');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
