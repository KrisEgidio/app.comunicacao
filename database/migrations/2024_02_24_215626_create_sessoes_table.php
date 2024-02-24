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
        Schema::create('sessoes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('descricao')->nullable();
            $table->date('data');
            $table->time('hora');
            $table->enum('tipo', ['magna_branca', 'magna', 'especial', 'ordinaria']);
            $table->longText('ordem_do_dia');
            $table->foreignId('loja_templo_id')->constrained('loja_templo')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessoes');
    }
};
