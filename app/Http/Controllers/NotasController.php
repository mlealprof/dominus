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
        $alunos = Aluno::query()->orderBy('nome', 'ASC')->get();
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
        
        
        
        
        $atividades = Atividade::query()->orderBy('data', 'desc') ->get();
        $notas = Notas::all();   
        $professores = Professor::query()->orderBy('nome')->get();
        
        

        if((session()->get('logado')<>'sim')){
             return view('auth.login');
       }

        $alunos = Aluno::all();      
       
        
        $modulos = Modulo::all(); 
        
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $professor_id = session()->get('professor_id');

         $disciplinas = Disciplina::query()->orderBy('id')->get();   


        if(session()->get('professor_id')<>''){


            $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')
                            ->join('cursos','cursos.id','=','turmas.curso')
                            ->where('turma_professor.professor_id','=',$professor_id)                              
                            ->select('turmas.nome as turma','turmas.id as turma_id','cursos.nome as curso','cursos.id as curso_id')
                            ->distinct('turmas.nome')
                            ->get();

            $disciplinas = DB::table('disciplinas')
                            ->join('turma_professor','disciplinas.id','=','turma_professor.disciplina_id')
                            ->where('turma_professor.professor_id','=',$professor_id)                              
                            ->select('disciplinas.id as disciplina_id','disciplinas.nome as disciplina')
                            ->distinct('disciplinas.nome')      
                            ->get();


           $cursos = DB::table('cursos')
                            ->join('turmas','turmas.curso','=','cursos.id')
                            ->join('turma_professor','turma_professor.turma_id','=','turmas.id')                            
                            ->where('turma_professor.professor_id','=',$professor_id)
                            
                            ->select('cursos.nome as curso','cursos.id as curso_id')
                            ->distinct('cursos.nome')

                            
                            ->get();




            
        }else{

         $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')
                            ->join('cursos','cursos.id','=','turmas.curso')                                                   
                            ->select('turmas.nome as turma','turmas.id as turma_id','cursos.nome as curso','cursos.id as curso_id')
                            ->distinct('turmas.nome')
                            ->get();

            $disciplinas = DB::table('disciplinas')
                            ->join('turma_professor','disciplinas.id','=','turma_professor.disciplina_id')
                            ->select('disciplinas.id as disciplina_id','disciplinas.nome as disciplina')
                            ->distinct('disciplinas.nome')                                                   
                            ->get();


           $cursos = DB::table('cursos')
                            ->join('turmas','turmas.curso','=','cursos.id')
                            ->join('turma_professor','turma_professor.turma_id','=','turmas.id')                            
                          
                            ->select('cursos.nome as curso','cursos.id as curso_id')
                            ->distinct('cursos.nome')

                            
                            ->get();


        }










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
