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
            $table->foreignId('compartilhado_por')->constrained('users');
            $table->foreignId('aceito_por')->constrained('users');
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->foreignId('loja_id')->constrained('lojas')->onDelete('cascade');
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
