<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id(); // Identificador único (autoincremental)
            $table->string('nombre')->unique(); // Nombre único de la categoría
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias');
    }
};
