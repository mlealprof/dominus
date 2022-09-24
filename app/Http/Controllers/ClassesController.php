<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Aluno;
use App\Models\Professor;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = Classe::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $modulos = Modulo::query()->orderBy('nome')->get();
        $alunos = Aluno::query()->orderBy('nome')->get();
        $professores = Professor::query()->orderBy('nome')->get();

        return view('classe.index')
            ->with('classes', $classes)
            ->with('cursos', $cursos)
            ->with('modulos', $modulos)
            ->with('alunos', $alunos)
            ->with('professores', $professores);
    }
    /*
     Cria uma nova turma
     */
    public function store(Request $request, Classe $classe)
    {

        $classe->nome = $request->nome;
        $classe->curso = $request->curso_id;
        $classe->modulo = $request->modulo_id;
        $classe->save();

        return redirect('classes');
    }

    /**
     * Atualiza uma turma existente
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classe $classe)
    {
        // Dados padrão da turma
        $classe->nome = $request->nome;
        $classe->curso = $request->curso_id;
        $classe->modulo = $request->modulo_id;

        // Opcionais da Turma



        $classe->save();

        return redirect('classes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();
        return redirect('classes');
    }
}
