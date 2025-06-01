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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cep');
            $table->string('rua');
            $table->string('numero');
            $table->string('bairro');
            $table->string('estado');
            $table->string('whatsapp');
            $table->string('documento');
            $table->foreignId('segmento_id')->constrained('segmentos')->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        //
    }
};
