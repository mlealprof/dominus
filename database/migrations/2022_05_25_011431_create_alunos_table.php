<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->integer('matricula');
            $table->string('nome');
            $table->string('turma')->nullable(true);
            $table->string('dataNascimento');
            $table->string('sexo');
            $table->string('rg')->nullable(true);
            $table->string('estadoEmissor')->nullable(true);
            $table->string('orgaoEmissor')->nullable(true);
            $table->string('dataExpedicao')->nullable(true);
            $table->string('telefone');
            $table->string('email');
            $table->string('endereco')->nullable(true);
            $table->string('numero')->nullable(true);
            $table->string('complemento')->nullable(true);
            $table->string('bairro')->nullable(true);
            $table->string('cep')->nullable(true);
            $table->string('cidade')->nullable(true);
            $table->string('estado')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
