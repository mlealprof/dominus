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


     if(session()->get('logado')<>'sim'){
        return view('auth.login');
     }

        $professor_id = session()->get('professor_id');
        $aulas_acao = Aulas::query()->orderBy('data', 'desc') ->get();  
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
       $disciplinas = Disciplina::query()->orderBy('id')->get(); 
        $professores = Professor::query()->orderBy('nome')->get();
       if(session()->get('professor_id')<>''){

            $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')
                            ->join('cursos','cursos.id','=','turmas.curso')
                            ->where('turma_professor.professor_id','=',$professor_id)                              
                            ->select('turmas.nome as turma','turmas.id as turma_id','cursos.nome as curso','cursos.id as curso_id')
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



           $aulas_acao = Aulas::where('professor_id','=',$professor_id)->get();
          $aulas = DB::table('aulas')
                                ->join('cursos','cursos.id','=','aulas.curso_id')
                                ->join('turmas','turmas.id','=','aulas.turma_id')
                                ->join('professores','professores.id','=','aulas.professor_id')
                                ->join('disciplinas','disciplinas.id','=','aulas.disciplina_id')
                                ->where('aulas.professor_id','=','0')                              
                                ->select('cursos.nome as curso','turmas.nome as turma','professores.nome as professor','aulas.*','aulas.id','disciplinas.nome as disciplina')
                                ->get();

          
        }else{    

           $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')
                            ->join('cursos','cursos.id','=','turmas.curso')
                                                    
                            ->select('turmas.nome as turma','turmas.id as turma_id','cursos.nome as curso','cursos.id as curso_id')
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

           $aulas_acao = Aulas::all();

            $aulas = DB::table('aulas')
                            ->join('cursos','cursos.id','=','aulas.curso_id')
                            ->join('turmas','turmas.id','=','aulas.turma_id')
                            ->join('professores','professores.id','=','aulas.professor_id')   
                            ->join('disciplinas','disciplinas.id','=','aulas.disciplina_id')   
                            ->where('cursos.id','=','0')                      
                            ->select('cursos.nome as curso','turmas.nome as turma','professores.nome as professor','aulas.data','aulas.conteudo','aulas.id','disciplinas.nome as disciplina')
                            ->get();

           
        }              
        
        return view('frequencia.index',[
            'turmas' => $turmas,
            'cursos' => $cursos,
            'disciplinas' => $disciplinas,
            'aulas' => $aulas,
            'professores' => $professores,
            'aulas_acao' => $aulas_acao
        ]);

     
    }

   

    public function show(){

    if(session()->get('logado')<>'sim'){
        return view('auth.login');
     }

        $professor_id = session()->get('professor_id');       
           
        
        $professores = Professor::query()->orderBy('nome')->get();
  

     if(session()->get('professor_id')<>''){

            

            $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')
                            ->join('cursos','cursos.id','=','turmas.curso')
                            ->where('turma_professor.professor_id','=',$professor_id)                              
                            ->select('turmas.nome as turma','turmas.id as turma_id','cursos.nome as curso','cursos.id as curso_id')
                            ->get();

            $disciplinas = DB::table('disciplinas')
                            ->join('turma_professor','disciplinas.id','=','turma_professor.disciplina_id')
                            ->where('turma_professor.professor_id','=',$professor_id)                              
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
                            ->get();

            $disciplinas = DB::table('disciplinas')
                            ->join('turma_professor','disciplinas.id','=','turma_professor.disciplina_id')
                            
                            ->get();

            $cursos = DB::table('cursos')
                            ->join('turmas','turmas.curso','=','cursos.id')
                            ->join('turma_professor','turma_professor.turma_id','=','turmas.id')                            
                            
                            
                            ->select('cursos.nome as curso','cursos.id as curso_id')
                            ->distinct('cursos.nome')

                            
                            ->get();
            
        }


        return view('frequencia.create',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,            
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

    public function faltas_lote(Request $request){
         if((session()->get('logado')<>'sim')){
                        return view('auth.login');
                     }

        $curso_id = $request->curso_id;
        $turma_id = $request->turma_id;
        $modulo_id = $request->modulo_id;        
        $disciplina_id = $request->disciplina_id;    
        $professor_id = session()->get('professor_id');
        $professores = Professor::query()->orderBy('nome')->get();


        


        if(session()->get('professor_id')<>''){


            $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')
                            ->join('cursos','cursos.id','=','turmas.curso')
                            ->where('turma_professor.professor_id','=',$professor_id)                              
                            ->select('turmas.nome as turma','turmas.id as turma_id','cursos.nome as curso','cursos.id as curso_id')
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



       //     $aulas_acao = Aulas::where('professor_id','=',$professor_id)->get();
          $aulas = DB::table('aulas')
                                ->join('cursos','cursos.id','=','aulas.curso_id')
                                ->join('turmas','turmas.id','=','aulas.turma_id')
                                ->join('professores','professores.id','=','aulas.professor_id')
                                ->join('disciplinas','disciplinas.id','=','aulas.disciplina_id')
                                ->where('aulas.professor_id','=',$professor_id)                              
                                 ->where('turmas.id','=',$turma_id)  
                                ->where('cursos.id','=',$curso_id)
                                ->where('disciplinas.id','=',$disciplina_id)
                                ->select('cursos.nome as curso','turmas.nome as turma','professores.nome as professor','aulas.*','aulas.id','disciplinas.nome as disciplina')
                                ->orderBy('aulas.data','desc')
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


          $aulas_acao = Aulas::where('professor_id','=',$professor_id)->get();
          $aulas = DB::table('aulas')
                                ->join('cursos','cursos.id','=','aulas.curso_id')
                                ->join('turmas','turmas.id','=','aulas.turma_id')
                                ->join('professores','professores.id','=','aulas.professor_id')
                                ->join('disciplinas','disciplinas.id','=','aulas.disciplina_id')                                                             
                                 ->where('turmas.id','=',$turma_id)  
                                ->where('cursos.id','=',$curso_id)
                                ->where('disciplinas.id','=',$disciplina_id)
                                ->select('cursos.nome as curso','turmas.nome as turma','professores.nome as professor','aulas.*','aulas.id','disciplinas.nome as disciplina')
                                ->orderBy('aulas.data','desc')
                                ->get();

        }
         
     
        return view('frequencia.faltas_lote',[
            'turmas' => $turmas,
            'cursos' => $cursos,
            'disciplinas' => $disciplinas,
            'aulas' => $aulas,
            'professores' => $professores,
            'aulas_acao' => $aulas_acao
        ]);


   }

    public function filtro(Request $request){
         if((session()->get('logado')<>'sim')){
                        return view('auth.login');
                     }

        $curso_id = $request->curso_id;
        $turma_id = $request->turma_id;
        $modulo_id = $request->modulo_id;        
        $disciplina_id = $request->disciplina_id;    
        $professor_id = session()->get('professor_id');
        $professores = Professor::query()->orderBy('nome')->get();

        if ($curso_id =='0'){
            $curso_id ='%%';          
        }
        if ($turma_id =='0'){
            $turma_id ='%%';          
        }
        if ($disciplina_id =='0'){
            $disciplina_id ='%%';          
        }

        


        if(session()->get('professor_id')<>''){


            $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')
                            ->join('cursos','cursos.id','=','turmas.curso')
                            ->where('turma_professor.professor_id','=',$professor_id)                              
                            ->select('turmas.nome as turma','turmas.id as turma_id','cursos.nome as curso','cursos.id as curso_id')
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



            $aulas_acao = Aulas::where('professor_id','=',$professor_id)->get();
          $aulas = DB::table('aulas')
                                ->join('cursos','cursos.id','=','aulas.curso_id')
                                ->join('turmas','turmas.id','=','aulas.turma_id')
                                ->join('professores','professores.id','=','aulas.professor_id')
                                ->join('disciplinas','disciplinas.id','=','aulas.disciplina_id')
                                ->where('aulas.professor_id','=',$professor_id)                              
                                 ->where('turmas.id','=',$turma_id)  
                                ->where('cursos.id','=',$curso_id)
                                ->where('disciplinas.id','=',$disciplina_id)
                                ->select('cursos.nome as curso','turmas.nome as turma','professores.nome as professor','aulas.*','aulas.id','disciplinas.nome as disciplina')
                                ->orderBy('aulas.data','desc')
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


          $aulas_acao = Aulas::where('professor_id','=',$professor_id)->get();
          $aulas = DB::table('aulas')
                                ->join('cursos','cursos.id','=','aulas.curso_id')
                                ->join('turmas','turmas.id','=','aulas.turma_id')
                                ->join('professores','professores.id','=','aulas.professor_id')
                                ->join('disciplinas','disciplinas.id','=','aulas.disciplina_id')                                                             
                                 ->where('turmas.id','=',$turma_id)  
                                ->where('cursos.id','=',$curso_id)
                                ->where('disciplinas.id','=',$disciplina_id)
                                ->select('cursos.nome as curso','turmas.nome as turma','professores.nome as professor','aulas.*','aulas.id','disciplinas.nome as disciplina')
                                ->orderBy('aulas.data','desc')
                                ->get();

        }
         
     
        return view('frequencia.index',[
            'turmas' => $turmas,
            'cursos' => $cursos,
            'disciplinas' => $disciplinas,
            'aulas' => $aulas,
            'professores' => $professores,
            'aulas_acao' => $aulas_acao
        ]);
}



}
