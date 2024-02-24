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
        Schema::create('compartilhamentos', function (Blueprint $table) {
            $table->id();
            $table->boolean('aceito')->default(false);
            $table->timestamp('data_aceite')->nullable();
            $table->foreignId('compartilhado_por')->constrained('usuarios');
            $table->foreignId('aceito_por')->constrained('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compartilhamentos');
    }
};
