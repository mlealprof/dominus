<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisciplinaDiaHorarioToTurmaProfessorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('turma_professor', function (Blueprint $table) {
            $table->string('disciplina')
                ->after('professor_id')
                ->nullable();
            $table->string('dia_semana')
                ->after('disciplina')
                ->nullable();
            $table->string('horario')
                ->after('dia_semana')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('turma_professor', function (Blueprint $table) {
            $table->dropColumn('disciplina', 'dia_semana','horario');
        });
    }
}
