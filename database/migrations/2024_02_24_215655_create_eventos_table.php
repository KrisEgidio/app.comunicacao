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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->longText('descricao');
            $table->time('hora');
            $table->date('data');
            $table->integer('grau');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cep');
            $table->foreignId('cidade_id')->constrained('cidades');
            $table->foreignId('loja_id')->constrained('lojas');
            $table->foreignId('criado_por')->constrained('users');
            $table->foreignId('imagem_id')->nullable()->constrained('imagens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
