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
        $cursos = Curso::query()->orderBy('nome')->get();        
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
        $modulos = Modulo::query()->orderBy('nome')->get();
        $professores = Professor::query()->orderBy('nome')->get();
        $turmas = Turma::query()->orderBy('id')->get();
        $turmas_aluno = TurmaAluno::query()->orderBy('id')->get(); 


        $aulas = Aulas::where('curso_id','=',$curso_id)->where('turma_id','=',$turma_id)->where('disciplina_id','=',$disciplina_id)->get();


        $qtaulas = count($aulas);
    
        $frequencias = DB::table('aulas')
            ->join('frequencia', 'aulas.id', '=', 'frequencia.aulas_id')
            ->join('alunos', 'alunos.id', '=', 'frequencia.aluno_id')
            ->select('aulas.*', 'frequencia.aluno_id', 'frequencia.presente','alunos.nome')
            ->orderBy('id')
            ->get();
        
        //dd($frequencias);


      return \PDF::loadView('frequencia.pdf_relatorio_frequencia', compact('alunos','turmas','turmas_aluno','aulas','frequencias','disciplina_id','disciplinas','curso_id','turma_id','modulo_id','professor_id','professores','modulos','qtaulas','cursos'))
                ->setPaper('A4', 'landscape')
                ->stream();

    }


 public function GeraPDF()
{
    $alunos = Aluno::all();
    $turma = 'teste';
 
 //   return view('frequencia.pdf_relatorio_frequencia',['alunos'=>$alunos]) ;

    return \PDF::loadView('frequencia.pdf_relatorio_frequencia', compact('alunos','turma'))
                // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
                ->stream();
    
}



    
 /* public function taleta(Request $request)
    {

        $curso_id = $request->curso_id;
        $turma_id = $request->turma_id;
        $modulo_id = $request->modulo_id;
        $professor_id = $request->professor_id;
        $disciplina_id = $request->disciplina_id;
        $alunos = Aluno::query()->orderBy('id')->get(); 
        $cursos = Curso::query()->orderBy('nome')->get();        
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
        $modulos = Modulo::query()->orderBy('nome')->get();
        $professores = Professor::query()->orderBy('nome')->get();
        $turmas = Turma::query()->orderBy('id')->get();
        $turmas_aluno = TurmaAluno::query()->orderBy('id')->get(); 


        $aulas = Aulas::where('curso_id','=',$curso_id)->where('turma_id','=',$turma_id)->where('disciplina_id','=',$disciplina_id)->get();


        $qtaulas = count($aulas);
    
        $frequencias = DB::table('aulas')
            ->join('frequencia', 'aulas.id', '=', 'frequencia.aulas_id')
            ->join('alunos', 'alunos.id', '=', 'frequencia.aluno_id')
            ->select('aulas.*', 'frequencia.aluno_id', 'frequencia.presente','alunos.nome')
            ->orderBy('id')
            ->get();
        
        //dd($frequencias);



      return view('frequencia.gerataletas',[
            'alunos' => $alunos,
            'turmas_aluno' => $turmas_aluno,
            'turmas' => $turmas,
            'aulas' => $aulas,
            'frequencias' => $frequencias,
            'disciplina_id' => $disciplina_id,
            'disciplinas' => $disciplinas,
            'curso_id' => $curso_id,
            'turma_id' => $turma_id,
            'modulo_id' => $modulo_id,
            'professor_id' => $professor_id,
            'professores' => $professores,
            'modulos' => $modulos,
            'qtaulas' =>$qtaulas,
            'cursos' => $cursos

            
        ]);
    }

*/




}
