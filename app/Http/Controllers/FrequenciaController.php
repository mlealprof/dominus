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
        
                
        $aulas = Aulas::findOrFail($id); 

        $professores = Professor::findOrFail($aulas->professor_id);

        $frequencias = DB::table('frequencia')
                      ->join('alunos','frequencia.aluno_id','=','alunos.id')
                      ->select('frequencia.*','alunos.nome')
                      ->where('frequencia.aulas_id','=', $id)
                      ->get();

      

        $turmas = Turma::findOrFail($aulas->turma_id);
        $cursos = Curso::findOrFail($aulas->curso_id);
        $disciplinas = Disciplina::findOrFail($aulas->disciplina_id); 

      

        return view('frequencia.frequencia',[
            
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



        $frequencia = Frequencia::findOrFail($frequencia_id);
        $frequencia->presente = 1;
        $frequencia->save();    

        $frequencias = DB::table('frequencia')->where('aulas_id', $frequencia->aulas_id)->get();

        return redirect('aulas/frequencia/'.$id.'#'.$frequencia->id);
    }

       public function updateNao($id,$frequencia_id)
    {


        $frequencia = Frequencia::findOrFail($frequencia_id);

        $frequencia->presente = 0;
        $frequencia->save();    
        $rota = 'aulas/frequencia/'.$id;
        $frequencias = DB::table('frequencia')->where('aulas_id', $frequencia->aulas_id)->get();

        return redirect('aulas/frequencia/'.$id.'#'.$frequencia->id);
        
   
    }
    public function relatorio()
    {
        $alunos = Aluno::all();
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get(); 
        $professores = Professor::query()->orderBy('nome')->get();
        $modulos = Modulo::all();

        return view('frequencia.relatoriosfrequencia',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'professores' => $professores,                  
            'modulos' => $modulos,
            'alunos' => $alunos
        ]);
    }

  public function taleta(Request $request)
    {

        $curso_id = $request->curso_id;
        $turma_id = $request->turma_id;
        $modulo_id = $request->modulo_id;
        $professor_id = $request->professor_id;
        $disciplina_id = $request->disciplina_id;

        $alunos = Aluno::query()->orderBy('id')->get(); 
        $cursos = Curso::findOrFail($curso_id);
        $disciplinas = Disciplina::findOrFail($disciplina_id);
        $modulos = Modulo::findOrFail($modulo_id);
        $professores = Professor::findOrFail($professor_id);
        $turmas = Turma::findOrFail($turma_id);
     

        $alunos_turma = DB::table('turma_aluno')
               ->join('alunos','turma_aluno.aluno_id','=','alunos.id')
               ->select('turma_aluno.*','alunos.nome','alunos.matricula')
               ->where('turma_id','=',$turma_id)
               ->orderBy('id')
               ->get();

       

        $aulas = Aulas::where('curso_id','=',$curso_id)->where('turma_id','=',$turma_id)->where('disciplina_id','=',$disciplina_id)->get();


        $qtaulas = count($aulas);
    
        $frequencias = DB::table('aulas')
            ->join('frequencia', 'aulas.id', '=', 'frequencia.aulas_id')
            ->join('alunos', 'alunos.id', '=', 'frequencia.aluno_id')
            ->select('aulas.*', 'frequencia.aluno_id', 'frequencia.presente','alunos.nome')
            ->where('aulas.curso_id','=',$curso_id)->where('aulas.turma_id','=',$turma_id)->where('aulas.disciplina_id','=',$disciplina_id)
            ->orderBy('id')
            ->get();
        
        //dd($frequencias);


      return \PDF::loadView('frequencia.pdf_relatorio_frequencia', compact('alunos','turmas','alunos_turma','aulas','frequencias','disciplina_id','disciplinas','curso_id','turma_id','modulo_id','professor_id','professores','modulos','qtaulas','cursos'))
                ->setPaper('A4', 'landscape')
                ->stream();

    }


 




}
