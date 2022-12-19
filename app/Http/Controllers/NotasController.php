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
use App\Models\Notas;

class NotasController extends Controller
{
       public function index($id)
    {
        $alunos = Aluno::all();
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
        $atividades = Atividade::query()->orderBy('data', 'desc') ->get();
        $notas = DB::table('notas')->where('atividade_id', $id)->get();

      
        $professores = Professor::query()->orderBy('nome')->get();
        return view('atividades.notas',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'atividades' => $atividades,
            'professores' => $professores,
            'id' => $id,
            'notas' => $notas,
            'alunos' => $alunos
        ]);
    }

    public function store($id)
    {


       $alunos = Aluno::all();
       $turmas = Turma::query()->orderBy('id')->get();
       $cursos = Curso::query()->orderBy('nome')->get();     
      
       $atividades = Atividade::query()->orderBy('id', 'desc') ->get(); 
       $turmas_aluno = TurmaAluno::query()->orderBy('id')->get(); 

       foreach($atividades as $atividades){
            if ($atividades->id == $id){                
               foreach ($turmas_aluno as $turma){
                  if ($turma->turma_id == $atividades->turma_id){
                       $alunos_turma = DB::table('turma_aluno')->where('turma_id', $atividades->turma_id)->get(); 
                       $turma_id = $atividades->turma_id;
                    }
                }
            }
        }
    
        foreach ($alunos_turma as $turma){  
               
            if ($turma->turma_id == $turma_id){
                   
                    $nota = new Notas() ;
                    $nota->aluno_id = $turma->aluno_id;
                    $nota->atividade_id = $id;
                    $nota->nota = 0;                    
                    $nota->save(); 
            }
        }

        


        return redirect('atividades/notas/'.$id);
 

    }


     public function update(Request $request,$id)
    {
        $nota = Notas::findOrFail($id);
        $nota->nota = $request->nota;
        $nota->save();  
       
        return redirect('atividades/notas/'.$nota->atividade_id);
    }

    public function relatorios(){
        $alunos = Aluno::all();
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
        $atividades = Atividade::query()->orderBy('data', 'desc') ->get();
        $notas = Notas::all();   
        $professores = Professor::query()->orderBy('nome')->get();
        $modulos = Modulo::all();
        


        return view('atividades.relatoriosnotas',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'atividades' => $atividades,
            'professores' => $professores,       
            'notas' => $notas,
            'modulos' => $modulos,
            'alunos' => $alunos
        ]);
    }
        public function boletim(){
        $alunos = Aluno::all();
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
        $atividades = Atividade::query()->orderBy('data', 'desc') ->get();
        $notas = Notas::all();   
        $professores = Professor::query()->orderBy('nome')->get();
        $modulos = Modulo::all();
        


        return view('boletim.index',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'atividades' => $atividades,
            'professores' => $professores,       
            'notas' => $notas,
            'modulos' => $modulos,
            'alunos' => $alunos
        ]);
    }



}
