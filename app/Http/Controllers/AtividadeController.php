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




class AtividadeController extends Controller

{

   public function index()
    {

      if((session()->get('logado')<>'sim')){
        return view('auth.login');
     }
        
        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $professor_id = session()->get('professor_id');

         $disciplinas = Disciplina::query()->orderBy('id')->get();   

         $atividades = Atividade::query()->orderBy('data', 'desc') ->get();

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



            $atividades = DB::table('atividade')
                            ->join('cursos','cursos.id','=','atividade.curso_id')
                            ->join('turmas','atividade.turma_id','=','turmas.id')
                            ->join('turma_professor','atividade.turma_id','=','turma_professor.turma_id')
                            ->join('disciplinas','turma_professor.disciplina_id','=','disciplinas.id')                           
                            ->where('turma_professor.professor_id','=','0')  
                            ->select('atividade.*','disciplinas.nome as disciplina','turmas.nome as turma','cursos.nome as curso','turmas.nome as nome',) 
                            

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

             $atividades = DB::table('atividade')
                            ->join('cursos','cursos.id','=','atividade.curso_id')
                            ->join('turmas','atividade.turma_id','=','turmas.id')
                            ->join('turma_professor','atividade.turma_id','=','turma_professor.turma_id')
                            ->join('disciplinas','turma_professor.disciplina_id','=','disciplinas.id')
                            ->where('cursos.id','=','0') 
                            ->select('atividade.*','disciplinas.nome as disciplina','turmas.nome as turma','cursos.nome as curso','turmas.nome as nome',)                     
                            ->get();

        }
         
     
        //dd($disciplinas);
        //dd($atividades);
        
      
        $professores = Professor::query()->orderBy('nome')->get();
        return view('atividades.index',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'atividades' => $atividades,
            'professores' => $professores
        ]);
    }

   
    public function show(){

        $turmas = Turma::query()->orderBy('id')->get();        
        $professor_id = session()->get('professor_id');

        $disciplinas = Disciplina::query()->orderBy('id')->get();   
        $atividades = Atividade::query()->orderBy('data', 'desc') ->get();
        $professores = Professor::query()->orderBy('nome')->get();

        if(session()->get('professor_id')<>''){
            

            $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')                            
                            ->where('turma_professor.professor_id','=',$professor_id)
                            ->select('turmas.nome as turma','turmas.id as turma_id')  
                            ->distinct('turmas.nome')                                                      
                            ->get();

            $cursos = DB::table('cursos')
                            ->join('turmas','turmas.curso','=','cursos.id')
                            ->join('turma_professor','turma_professor.turma_id','=','turmas.id')                            
                            ->where('turma_professor.professor_id','=',$professor_id)
                            
                            ->select('cursos.nome as curso','cursos.id as curso_id')
                            ->distinct('cursos.nome')

                            
                            ->get();

            $disciplinas = DB::table('disciplinas')
                            ->join('turma_professor','disciplinas.id','=','turma_professor.disciplina_id')
                            ->where('turma_professor.professor_id','=',$professor_id)  
                            ->distinct('disciplinas.nome')                            
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
                            ->distinct('disciplinas.nome')                            
                            ->get();

            $cursos = DB::table('cursos')
                            ->join('turmas','turmas.curso','=','cursos.id')
                            ->join('turma_professor','turma_professor.turma_id','=','turmas.id')                            
                            ->select('cursos.nome as curso','cursos.id as curso_id')
                            ->distinct('cursos.nome')

                            
                            ->get();


        }

       //dd($cursos);        
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

        $recuperacao =  $request->recuperacao; 
        if ($recuperacao == 'on')  {
            $recuperacao = 1;
        }else{
            $recuperacao = 0;
        }
        $atividade = new Atividade();
        $atividade->curso_id = $request->curso_id;
        $atividade->turma_id = $request->turma_id;
        $atividade->disciplina_id = $request->disciplina_id;
        $atividade->data = $request->data;
        $atividade->conteudo = $request->conteudo;
        $atividade->valor = $request->valor;           
        $atividade->recuperacao = $recuperacao; 
        $atividade->save();

        return redirect('atividades');
    }

    public function update(Request $request, $id)
    {
        $recuperacao =  $request->recuperacao; 
        if ($recuperacao == 'on')  {
            $recuperacao = 1;
        }else{
            $recuperacao = 0;
        } 

        $atividade=Atividade::findOrFail($id);
        $atividade->turma_id = $request->turma_id;
        $atividade->curso_id = $request->curso_id;
        $atividade->disciplina_id = $request->disciplina_id;        
        $atividade->data = $request->data;
        $atividade->conteudo = $request->conteudo;
        $atividade->valor = $request->valor;
         $atividade->recuperacao = $recuperacao; 
        $atividade->save();

        return redirect('atividades');
    }
    public function destroy($id)
    {
       $notas = Notas::all();
       foreach ($notas as $nota){
        if ($nota->atividade_id == $id){
            $nota->delete();
        }
       }

        $atividade = Atividade::findOrFail($id);
        $atividade->delete();
        return redirect('atividades');


    }
   
  public function relatorio(Request $request)
    {
        $curso_id = $request->curso_id;
        $turma_id = $request->turma_id;
        $modulo_id = $request->modulo_id;
        $professor_id = $request->professor_id;
        $disciplina_id = $request->disciplina_id;
         
        

        $cursos = Curso::findOrFail($curso_id);        
        $disciplinas = Disciplina::findOrFail($disciplina_id);
        $modulos = Modulo::findOrFail($modulo_id);
        $professores = Professor::findOrFail($professor_id);
        $turmas = Turma::findOrFail($turma_id);
    
       
        $turmas_aluno = DB::table('turma_aluno')
                        ->join('alunos','turma_aluno.aluno_id','=','alunos.id')
                        ->where('turma_aluno.turma_id','=',$turma_id) 
                        ->orderBy('alunos.nome','asc')                      
                        ->get();

        $atividades = Atividade::where('disciplina_id','=',$disciplina_id)->where('turma_id','=',$turma_id)->where('curso_id','=',$curso_id)->orderBy('data','asc')->get();
       
        $total_notas=0;

        foreach($atividades as $atividade){
            if ($atividade->recuperacao=='0'){
               $total_notas+=$atividade->valor;
            }
        }
      
   
    

        $notas = DB::table('notas')
                ->join('atividade','notas.atividade_id','=','atividade.id')
                ->where('atividade.disciplina_id','=',$disciplina_id)
                ->where('atividade.turma_id','=',$turma_id)
                ->where('atividade.curso_id','=',$curso_id)
            
                ->get();


    

      return \PDF::loadView('atividades.pdf_relatorio_nota', compact('cursos','disciplinas','modulos','professores','turmas','turmas_aluno','atividades','notas','turma_id','modulo_id','professor_id','disciplina_id','curso_id','total_notas'))
                ->setPaper('A4', 'landscape')
                ->stream();

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



            $atividades = DB::table('atividade')
                            ->join('cursos','cursos.id','=','atividade.curso_id')
                            ->join('turmas','atividade.turma_id','=','turmas.id')
                            ->join('turma_professor','atividade.turma_id','=','turma_professor.turma_id')
                            ->join('disciplinas','turma_professor.disciplina_id','=','disciplinas.id')                           
                            ->where('turma_professor.professor_id','like',$professor_id)  
                            ->where('turmas.id','like',$turma_id)  
                            ->where('cursos.id','like',$curso_id)
                            ->where('disciplinas.id','=',$disciplina_id)
                            ->where('atividade.disciplina_id','=',$disciplina_id)
                            ->select('atividade.*','disciplinas.nome as disciplina','turmas.nome as turma','cursos.nome as curso') 
                            ->orderBy('atividade.id','desc')

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



            $atividades = DB::table('atividade')
                            ->join('cursos','cursos.id','=','atividade.curso_id')
                            ->join('turmas','atividade.turma_id','=','turmas.id')
                            ->join('turma_professor','atividade.turma_id','=','turma_professor.turma_id')
                            ->join('disciplinas','turma_professor.disciplina_id','=','disciplinas.id')                           
                          
                            ->where('turmas.id','like',$turma_id)  
                            ->where('cursos.id','like',$curso_id)
                            ->where('disciplinas.id','=',$disciplina_id)
                            ->where('atividade.disciplina_id','=',$disciplina_id)
                            ->select('atividade.*','disciplinas.nome as disciplina','turmas.nome as turma','cursos.nome as curso') 
                            ->orderBy('atividade.id','desc')
                            ->get();
                         

        }
         
     
        //dd($disciplinas);
       // dd($atividades);
        
      
        $professores = Professor::query()->orderBy('nome')->get();
        return view('atividades.index',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'atividades' => $atividades,
            'professores' => $professores
        ]);
    }









/*


    public function relatorio(Request $request)
    {
        $alunos = Aluno::query()->orderBy('id')->get(); 

        
        $cursos = Curso::query()->orderBy('nome')->get();
        $notas = Notas::all();   
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
        $modulos = Modulo::query()->orderBy('nome')->get();
        $professores = Professor::query()->orderBy('nome')->get();
        $turmas = Turma::query()->orderBy('id')->get();
        $curso_id = $request->curso_id;
        $turma_id = $request->turma_id;
        $modulo_id = $request->modulo_id;
        $professor_id = $request->professor_id;
        $disciplina_id = $request->disciplina_id;
        $turmas_aluno = TurmaAluno::query()->orderBy('id')->get(); 

        $atividades = Atividade::where('disciplina_id','=',$disciplina_id)->where('turma_id','=',$turma_id)->where('curso_id','=',$curso_id)->get();


    
        

      return view('atividades.gerataletas',[
            'alunos' => $alunos,
            'turmas_aluno' => $turmas_aluno,
            'turmas' => $turmas,
            'atividades' => $atividades,
            'notas' => $notas,
            'disciplina_id' => $disciplina_id,
            'disciplinas' => $disciplinas,
            'curso_id' => $curso_id,
            'turma_id' => $turma_id,
            'modulo_id' => $modulo_id,
            'professor_id' => $professor_id,
            'professores' => $professores,
            'modulos' => $modulos,
            'cursos' => $cursos

            
        ]);
    }
    */


}
