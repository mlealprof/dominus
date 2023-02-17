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

        

        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('id')->get();  
        $aulas = Aulas::query()->orderBy('data', 'desc') ->get();
        $professor_id = session()->get('professor_id');

        $aulas_acao = Aulas::query()->orderBy('data', 'desc') ->get();

         if(session()->get('professor_id')<>''){

            $aulas = DB::table('aulas')
                            ->join('disciplinas','aulas.disciplina_id','=','disciplinas.id')                          
                            ->where('aulas.professor_id','=',$professor_id)  
                            ->select('aulas.*', 'disciplinas.nome')                     
                            ->get();
   
        }

     //   dd($aulas);
      
        $professores = Professor::query()->orderBy('nome')->get();
        return view('frequencia.index',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'aulas' => $aulas,
            'professores' => $professores,
            'aulas_acao' => $aulas_acao
        ]);

     
    }

   public function nova()
    {

    if(session()->get('logado')<>'sim'){
        return view('auth.login');
     }

        $professor_id = session()->get('professor_id');

        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('nome')->get();  
        $aulas = Aulas::query()->orderBy('data', 'desc') ->get();
      
        $professores = Professor::query()->orderBy('nome')->get();

       if(session()->get('professor_id')<>''){

            $professores = Professor::findOrFail($professor_id);

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
   
        }


    //   dd($turmas);

        return view('frequencia.create',[
            'turmas' => $turmas,
            'cursos' => $cursos,            
            'disciplinas' => $disciplinas,
            'aulas' => $aulas,
            'professores' => $professores
        ]);
    }

    public function show(){

    if(session()->get('logado')<>'sim'){
        return view('auth.login');
     }



        $professor_id = session()->get('professor_id');

        $turmas = Turma::query()->orderBy('id')->get();
        $cursos = Curso::query()->orderBy('nome')->get();
        $disciplinas = Disciplina::query()->orderBy('nome')->get();  
        $aulas = Aulas::query()->orderBy('data', 'desc') ->get();
      
        $professores = Professor::query()->orderBy('nome')->get();

       if(session()->get('professor_id')<>''){

            $professores = Professor::findOrFail($professor_id);

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
   
        }


       //dd($turmas);   
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
