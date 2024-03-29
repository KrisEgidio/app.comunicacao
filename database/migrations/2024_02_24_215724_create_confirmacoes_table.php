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
        Schema::create('confirmacoes', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->timestamp('confirmado_em')->nullable();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('evento_id')->constrained('eventos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmacoes');
    }
};
