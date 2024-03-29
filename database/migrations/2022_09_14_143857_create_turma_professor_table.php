<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurmaProfessorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turma_professor', function (Blueprint $table) {
            $table->id();
            $table->integer('turma_id')->unsigned();
            $table->integer('modulo_id')->unsigned();
            $table->integer('professor_id')->unsigned();
            $table->integer('disciplina_id')->unsigned();
            $table->string('dia_semana');
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
        Schema::dropIfExists('turma_professor');
    }
}
