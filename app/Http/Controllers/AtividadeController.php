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

    public function update(Request $request, $id)
    {
        $atividade=Atividade::findOrFail($id);
        $atividade->turma_id = $request->turma_id;
        $atividade->curso_id = $request->curso_id;
        $atividade->disciplina_id = $request->disciplina_id;        
        $atividade->data = $request->data;
        $atividade->conteudo = $request->conteudo;
        $atividade->valor = $request->valor;
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
                        ->get();

        $atividades = Atividade::where('disciplina_id','=',$disciplina_id)->where('turma_id','=',$turma_id)->where('curso_id','=',$curso_id)->get();
        $total_notas=0;

        foreach($atividades as $atividade){
            $total_notas+=$atividade->valor;
        }
      

        $soma = 

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
