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
use App\Models\Atividade;



class AtividadeController extends Controller

{

   public function index()
    {
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
        $atividades = Atividade::query()->orderBy('data', 'desc') ->get();
      
        $professores = Professor::query()->orderBy('nome')->get();
        return view('atividades.index',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'atividades' => $atividades,
            'professores' => $professores
        ]);
    }
     public function nova()
    {
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('nome')->get();  
        $atividades = Atividade::query()->orderBy('data', 'desc') ->get();
      
        $professores = Professor::query()->orderBy('nome')->get();

        return view('atividades.create',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'atividades' => $atividades,
            'professores' => $professores
        ]);
    }

    public function show(){
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
       $atividades = Atividade::query()->orderBy('data', 'desc') ->get();
      
        $professores = Professor::query()->orderBy('nome')->get();
        
        return view('atividades.create',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'atividades' => $atividades,
            'professores' => $professores
        ]);
    }

     public function store(Request $request)
    {        
        $atividade = new Atividade();
        $atividade->curso_id = $request->curso_id;
        $atividade->turma_id = $request->turma_id;
        $atividade->disciplina_id = $request->disciplina_id;
        $atividade->data = $request->data;
        $atividade->conteudo = $request->conteudo;
        $atividade->valor = $request->valor;           
        $atividade->save();

        return redirect('atividades');
    }
}
