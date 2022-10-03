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
use App\Models\Frequencia;
use App\Models\TurmaProfessor;
use App\Models\Horario;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Estado;

class FrequenciaController extends Controller
{
    
    public function index($id)
    {
        
        $alunos = Aluno::all();
        $aulas = Aulas::query()->orderBy('id', 'desc') ->get();   
        $professores = Professor::query()->orderBy('nome')->get();
        $frequencias = DB::table('frequencia')->where('aulas_id', $id)->get();
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get(); 



        return view('frequencia.frequencia',[
            'alunos' => $alunos,
            'frequencias' => $frequencias,
            'aulas' => $aulas,            
            'turmas' => $turmas,
            'cursos' => $cursos,
            'disciplinas' => $disciplinas,
            'professores' => $professores,
            'id' => $id
            
        ]);
    }
 
public function store($id)
    {
       $alunos = Aluno::all();
       $turmas = Turma::query()->orderBy('id')->get();
       $cursos = Curso::query()->orderBy('nome')->get();
       $professores = Professor::query()->orderBy('nome')->get();
       $disciplinas = Disciplina::query()->orderBy('id')->get(); 
       $aulas = Aulas::query()->orderBy('id', 'desc') ->get(); 
       $turmas_aluno = TurmaAluno::query()->orderBy('id')->get(); 

       foreach($aulas as $aula){
            if ($aula->id == $id){                
               foreach ($turmas_aluno as $turma){
                  if ($turma->turma_id == $aula->turma_id){
                       $alunos_turma = DB::table('turma_aluno')->where('turma_id', $aula->turma_id)->get(); 
                       $turma_id = $aula->turma_id;
                    }
                }
            }
        }
    
        foreach ($alunos_turma as $turma){    
               
            if ($turma->turma_id == $turma_id){
                   
                    $frequencia = new Frequencia() ;
                    $frequencia->aluno_id = $turma->aluno_id;
                    $frequencia->aulas_id = $id;
                    $frequencia->presente = 1;                    
                    $frequencia->save(); 
            }
        }

        $frequencias = DB::table('frequencia')->where('aulas_id', $id)->get();



        return redirect('aulas/frequencia/'.$id);
       
    }

   public function updateSim($id,$frequencia_id)
    {

       $alunos = Aluno::all();
       $turmas = Turma::query()->orderBy('id')->get();
       $cursos = Curso::query()->orderBy('nome')->get();
       $professores = Professor::query()->orderBy('nome')->get();
       $disciplinas = Disciplina::query()->orderBy('id')->get(); 
       $aulas = Aulas::query()->orderBy('id', 'desc') ->get(); 
       $turmas_aluno = TurmaAluno::query()->orderBy('id')->get(); 





        $frequencia = Frequencia::findOrFail($frequencia_id);
        $frequencia->presente = 1;
        $frequencia->save();    

        $frequencias = DB::table('frequencia')->where('aulas_id', $frequencia->aulas_id)->get();

        return redirect('aulas/frequencia/'.$id);
    }

       public function updateNao($id,$frequencia_id)
    {

       $alunos = Aluno::all();
       $turmas = Turma::query()->orderBy('id')->get();
       $cursos = Curso::query()->orderBy('nome')->get();
       $professores = Professor::query()->orderBy('nome')->get();
       $disciplinas = Disciplina::query()->orderBy('id')->get(); 
       $aulas = Aulas::query()->orderBy('id', 'desc') ->get(); 
       $turmas_aluno = TurmaAluno::query()->orderBy('id')->get(); 



        $frequencia = Frequencia::findOrFail($frequencia_id);
        $frequencia->presente = 0;
        $frequencia->save();    
        $rota = 'aulas/frequencia/'.$id;
        $frequencias = DB::table('frequencia')->where('aulas_id', $frequencia->aulas_id)->get();
        return redirect('aulas/frequencia/'.$id);
        
   
    }

}