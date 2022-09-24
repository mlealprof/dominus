<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Aluno;
use App\Models\Disciplina;
use App\Models\Professor;
use App\Models\TurmaAluno;
use App\Models\TurmaProfessor;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $modulos = Modulo::query()->orderBy('nome')->get();
        $alunos = Aluno::query()->orderBy('nome')->get();
        $professores = Professor::query()->orderBy('nome')->get();
        return view('turmas.index',[
            'turmas' => $turmas,
            'cursos' => $cursos,
            'modulos' => $modulos,
            'alunos' => $alunos,
            'professores' => $professores
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::query()->orderBy('nome')->get();
        $modulos = Modulo::query()->orderBy('nome')->get();
        return view('turmas.create',[
            'cursos' => $cursos,
            'modulos' => $modulos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Turma $turma)
    {
        $turma->nome = $request->nome;
        $turma->curso = $request->curso_id;
        $turma->modulo = $request->modulo_id;
        $turma->save();

        return redirect('turmas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function show(Turma $turma)
    {
        $cursos = $turma->cursos()->get();
        return view('turmas.view',[
            'turma' => $turma,
            'cursos' => $cursos
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function edit(Turma $turma)
    {
        //
    }

    /**
     * Update the specified resour$turmas = Turma::query()->orderBy('id')->get();ce in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turma $turma)
    {
        $turma->nome = $request->nome;
        $turma->curso = $request->curso_id;
        $turma->modulo = $request->modulo_id;
        $turma->save();

        return redirect('turmas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turma $turma)
    {
        $turma->delete();
        return redirect('turmas');
    }

    /**
     * Exibe os alunos presentes na turma
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function Alunos(Turma $turma)
    {
        $todosAlunos = Aluno::query()->orderBy('nome')->get();
        $alunos = DB::table('turma_aluno')->where('turma_id', $turma->id)->get();

        return view('turmas.alunos',[
            'todosAlunos' => $todosAlunos,
            'alunos' => $alunos,
            'turma' => $turma
        ]);
    }

    /**
     * Armazena um aluno a turma.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAluno(Request $request,Turma $turma, TurmaAluno $turmaAluno)
    {
        $turmaAluno->turma_id = $request->turma_id;
        $turmaAluno->aluno_id = $request->aluno_id;
        $turmaAluno->save();
        return redirect()->route('turma.aluno.show', ['turma'=>$request->turma_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function destroyAluno(Turma $turma, TurmaAluno $turmaAluno, $id)
    {

        $deleted = DB::table('turma_aluno')
            ->where('turma_id','=',$turma->id)
            ->where('id','=',$id)
            ->delete();
        return redirect()->route('turma.aluno.show', ['turma'=>$turma->id]);
    }

    /**
     * Exibe os professores presentes na turma
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function Professores(Turma $turma)
    {
        $todosProfessores = Professor::query()->orderBy('nome')->get();
        $professores = DB::table('turma_professor')->where('turma_id', $turma->id)->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get();
        $horarios = Horario::query()->orderBy('aula')->get();

        return view('turmas.professores',[
            'todosProfessores' => $todosProfessores,
            'professores' => $professores,
            'turma' => $turma,
            'disciplinas' => $disciplinas,
            'horarios' => $horarios
        ]);
    }

    /**
     * Armazena um aluno a turma.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeProfessor(Request $request,Turma $turma, TurmaProfessor $turmaProfessor)
    {
        $turmaProfessor->turma_id = $request->turma_id;
        $turmaProfessor->professor_id = $request->professor_id;
        $turmaProfessor->save();
        return redirect()->route('turma.professor.show', ['turma'=>$request->turma_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Turma  $turma
     * @return \Illuminate\Http\Response
     */
    public function destroyProfessor(Turma $turma, TurmaProfessor $turmaProfessor, $id)
    {

        $deleted = DB::table('turma_professor')
            ->where('turma_id','=',$turma->id)
            ->where('id','=',$id)
            ->delete();
        return redirect()->route('turma.professor.show', ['turma'=>$turma->id]);
    }
}
