<?php

namespace App\Http\Controllers;


use App\Models\Turma;
use App\Models\Aulas;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Professor;
use App\Models\TurmaAluno;
use App\Models\TurmaProfessor;
use App\Models\Horario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Estado;

class AulasController extends Controller
{
   public function index()
    {
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
        $aulas = Aulas::query()->orderBy('data', 'desc') ->get();
      
        $professores = Professor::query()->orderBy('nome')->get();
        return view('frequencia.index',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'aulas' => $aulas,
            'professores' => $professores
        ]);
    }

   public function nova()
    {
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('nome')->get();  
        $aulas = Aulas::query()->orderBy('data', 'desc') ->get();
      
        $professores = Professor::query()->orderBy('nome')->get();

        return view('frequencia.create',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'aulas' => $aulas,
            'professores' => $professores
        ]);
    }

    public function show(){
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
        $aulas = Aulas::query()->orderBy('data', 'desc') ->get();
      
        $professores = Professor::query()->orderBy('nome')->get();
        
        return view('frequencia.create',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'aulas' => $aulas,
            'professores' => $professores
        ]);
    }


    public function store(Request $request)
    {
        $aulas = new Aulas();
        $aulas->turma_id = $request->turma_id;
        $aulas->curso_id = $request->curso_id;
        $aulas->disciplina_id = $request->disciplina_id;
        $aulas->professor_id = $request->professor_id;
        $aulas->data = $request->data;
        $aulas->conteudo = $request->conteudo;        
        $aulas->save();

        return redirect('aulas');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aulas $aula)
    {
        $aula->turma_id = $request->turma_id;
        $aula->curso_id = $request->curso_id;
        $aula->disciplina_id = $request->disciplina_id;
        $aula->professor_id = $request->professor_id;
        $aula->data = $request->data;
        $aula->conteudo = $request->conteudo;
        $aula->save();

        return redirect('aulas');
    }
    public function destroy(Aulas $aula)
    {
        $aula->delete();
        return redirect('aulas');
    }



}
