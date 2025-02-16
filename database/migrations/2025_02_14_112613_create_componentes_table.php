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
        Schema::create('componentes', function (Blueprint $table) {
            $table->engine="InnoDB";
            $table->id();
            $table->string('modelo');
            $table->bigInteger('categoria_producto')->unsigned();
            $table->bigInteger('estado_producto')->unsigned();
            $table->foreign('categoria_producto')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('estado_producto')->references('id')->on('estados')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('componentes');
    }
};
