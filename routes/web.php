<?php

use App\Http\Controllers\AlunosController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\ProfessoresController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\TurmaProfessorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\FrequenciaController;
use App\Http\Controllers\AulasController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\AtividadeController;

use App\Models\Modulo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

//Login
Route::get('login', [LoginController::class, 'index']);
Route::get('home', [HomeController::class, 'index']);
Route::post('autenticate', [LoginController::class, 'autenticate']);
Route::get('sair', [LoginController::class, 'sair']);

//Aulas

Route::resource('aulas',AulasController::class)->names('aulas')->parameters(['aulas'=>'aula']);
Route::get('aulas/frequencia/{id}', [FrequenciaController::class, 'index'])->name('aulas.frequencia.show');
Route::get('aulas/frequencia/show/{id}', [FrequenciaController::class, 'filtro','$id'])->name('aulas.frequencia.filtro');
Route::get('aulas/frequencia/copiar/{id}', [FrequenciaController::class, 'copiar','$id'])->name('aulas.frequencia.show');
Route::post('aulas/frequencia/{id}/lancar', [FrequenciaController::class, 'store','$id']);
Route::post('aulas/frequencia/{id}/atualizar', [FrequenciaController::class, 'atualizar','$id']);
Route::post('aulas/frequencia/{id}/salvar', [FrequenciaController::class, 'atualiza_presenca','$id']);
Route::get('aulas/frequencia/{id}/lancar', [FrequenciaController::class, 'store','$id']);
Route::get('aulas/frequencia/{id}/{frequencia_id}/sim', [FrequenciaController::class, 'updateSim']);
Route::get('aulas/frequencia/{id}/{frequencia_id}/nao', [FrequenciaController::class, 'updateNao']);
Route::post('/aulas', [AulasController::class,'filtro'])->name('aulas.filtro');
Route::post('/aulas/nova', [AulasController::class,'store'])->name('aulas.store');
Route::get('/faltas_lote', [AulasController::class,'faltas_lote'])->name('aulas.faltas_lote');


Route::post('/faltas_lote_alterando', [FrequenciaController::class,'faltas_lote'])->name('frequencia.faltas');
Route::post('/lote/{frequencia_id}/sim', [FrequenciaController::class, 'updateSim_lote']);
Route::post('/lote/{frequencia_id}/nao', [FrequenciaController::class, 'updateNao_lote']);
Route::get('/faltas_lote_alterando', [FrequenciaController::class,'faltas_lote'])->name('frequencia.faltas');
Route::get('/lote/{frequencia_id}/sim', [FrequenciaController::class, 'updateSim_lote']);
Route::get('/lote/{frequencia_id}/nao', [FrequenciaController::class, 'updateNao_lote']);


Route::get('pdf', [FrequenciaController::class, 'GeraPDF']);



Route::post('/quadro_aviso', [HomeController::class,'salvar']);


//Atividades
Route::resource('atividades',AtividadeController::class)->names('index')->parameters(['atividades'=>'atividades']);
Route::get('/atividades/nova', [AtividadeController::class,'nova'])->name('atividade.show');
Route::post('/atividades/nova', [AtividadeController::class,'store'])->name('atividade.store');
Route::put('atividades/alterar/{id}', [AtividadeController::class, 'update','$id']);
Route::delete('atividades/excluir/{id}', [AtividadeController::class,'destroy','$id']);
Route::post('/atividades', [AtividadeController::class,'filtro'])->name('atividades.filtro');



Route::get('atividades/notas/{id}', [NotasController::class, 'index'])->name('atividades.notas.show');



Route::post('atividades/notas/{id}/lancar', [NotasController::class, 'store','$id']);
Route::post('atividades/notas/{id}/atualizar', [NotasController::class, 'atualizar','$id']);
Route::post('atividades/notas/{id}/salvar', [NotasController::class, 'altera_nota','$id']);
Route::get('atividades/notas/{id}/lancar', [NotasController::class, 'store','$id']);
Route::post('atividades/notas/{id}/alterar', [NotasController::class, 'update','$id']);
Route::get('atividades/notas/{id}/alterar', [NotasController::class, 'update','$id']);

//RELATÓRIOS
Route::get('relatoriosnotas', [NotasController::class, 'relatorios']);
Route::post('/relatorios/geratargetanotas', [AtividadeController::class,'relatorio'])->name('atividade.relatorio');
Route::get('relatoriosfrequencia', [FrequenciaController::class, 'relatorio']);
Route::get('relatoriosaula', [FrequenciaController::class, 'relatorioaula']);

Route::post('/relatorios/geratargetafrequencia', [FrequenciaController::class,'taleta'])->name('frequencia.relatorio');
Route::post('/relatorios/geratargetaaula', [FrequenciaController::class,'taleta_aula'])->name('aula.relatorio');

Route::get('/boletim', [NotasController::class, 'boletim']);





// Resources
Route::resource('professores',ProfessoresController::class)->names('professor')->parameters(['professores'=>'professor']);
Route::resource('alunos',AlunosController::class)->names('aluno')->parameters(['alunos'=>'aluno']);
Route::resource('cursos',CursosController::class)->names('curso')->parameters(['cursos'=>'curso']);
Route::resource('modulos',ModulosController::class)->names('modulo')->parameters(['modulos'=>'modulo']);
Route::resource('classes',ClassesController::class)->names('classe')->parameters(['classes'=>'classe']);
Route::resource('disciplinas',DisciplinaController::class)->names('disciplina')->parameters(['disciplinas'=>'disciplina']);
Route::resource('horarios',HorarioController::class)->names('horario')->parameters(['horarios'=>'horario']);


// TURMAS
Route::resource('turmas',TurmaController::class)->names('turma')->parameters(['turmas'=>'turma']);

    // Alunos
    Route::get('/turmas/{turma}/alunos',[TurmaController::class,'alunos'])->name('turma.aluno.show');
  
    Route::delete('/turmas/{turma}/{aluno}',[TurmaController::class,'destroyAluno'])->name('turma.aluno.destroy');
    Route::post('/turmas/aluno',[TurmaController::class,'storeAluno'])->name('turma.aluno.store');
    // professores
    Route::get('/turmas/{turma}/professor',[TurmaController::class,'professores'])->name('turma.professor.show');
    Route::delete('/turmas/{turma}/{professor}/professor',[TurmaProfessorController::class,'destroy'])->name('turma.professor.destroy');
    Route::post('/turmas/professor',[TurmaProfessorController::class,'store'])->name('turma.professor.store');


//Cadastro de Usuários
Route::get('usuarios', [LoginController::class, 'usuarios']);    
Route::get('/usuarios/novo', [LoginController::class,'usuario_index'])->name('usuarios.create');
Route::get('/usuarios/salvar', [LoginController::class,'usuario_store'])->name('usuario.store');












//Autocomplete

Route::get('/alteraNota/{id}/{nota}/{atividade}', [NotasController::class, 'altera_nota'])->name('get.altera_nota');






Route::get('/getmodulo/{id}', function ($id) {
    $result = DB::table('modulos')->where('curso_id', $id)->get();
    echo '<option value="0">Selecione...</option>';
    foreach ($result as $modulo) {
        echo '<option value="'.$modulo->id .'">' .$modulo->nome.'</option>';
    }
})->name('get.modulo');




Route::get('/getturma/{id}', function ($id) {
    $professor_id = session()->get('professor_id');

    if(session()->get('professor_id')<>''){
      $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')                            
                            ->join('cursos','cursos.id','=','turmas.curso')   
                            ->where('turma_professor.professor_id','=',$professor_id)                              
                            ->where('cursos.id','=',$id)  
                            ->select('turmas.nome as turma','turmas.id as turma_id')
                            ->distinct('turmas.nome')                                                         
                            ->get();
    }else{
       $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')                            
                            ->join('cursos','cursos.id','=','turmas.curso')   
                            ->where('cursos.id','=',$id)
                            ->select('turmas.nome as turma','turmas.id as turma_id')                            
                            ->distinct('turmas.nome')
                            ->get();
    }

    
    echo '<option value="0">Selecione...</option>';
    foreach ($turmas as $turma) {
        echo '<option value="'.$turma->turma_id .'">' .$turma->turma.'</option>';
    }
})->name('get.turma');






Route::get('/getturmamodulo/{id}', function ($id) {
    $professor_id = session()->get('professor_id');

    if(session()->get('professor_id')<>''){
      $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')                           
                            ->where('turmas.modulo','=',$id)
                            ->where('turma_professor.professor_id','=',$professor_id)                              
                            ->select('turmas.nome as turma','turmas.id as turma_id')                            
                            ->distinct('turmas.nome') 
                            ->get();
    }else{
       $turmas = DB::table('turmas')
                            ->join('turma_professor','turmas.id','=','turma_professor.turma_id')
                            
                            ->where('turmas.modulo','=',$id)
                           
                            ->select('turmas.nome as turma','turmas.id as turma_id') 
                            ->distinct('turmas.nome')                           
                            ->get();
    } 
    echo '<option value="0">Selecione...</option>';
    foreach ($turmas as $turma) {
        echo '<option value="'.$turma->turma_id .'">' .$turma->turma.'</option>';
    }
})->name('get.turmamodulo');



Route::get('/getdisciplina/{id}', function ($id) {    

    $professor_id = session()->get('professor_id');
    if(session()->get('professor_id')<>''){
       $resultados = DB::table('turma_professor')->where('turma_id', $id)->where('professor_id', $professor_id)->get();     
    }else{
       $resultados = DB::table('turma_professor')->where('turma_id', $id)->get();      
    }

    

    echo '<option value="0">Selecione...</option>';       
    foreach ($resultados as $turma) {
        $disciplinas = DB::table('disciplinas')->where('id', $turma->disciplina_id)->get();
        foreach ($disciplinas as $disciplina){
           echo '<option value="'.$turma->disciplina_id.'">' .$disciplina->nome.'</option>';                
        }
   }      
})->name('get.disciplina');



Route::get('/getprofessor/{id}', function ($id) {    
    $professor_id = session()->get('professor_id');
    if(session()->get('professor_id')<>''){
       $resultados = DB::table('turma_professor')->where('disciplina_id', $id)->where('professor_id', $professor_id)->get();     
    }else{
       $resultados = DB::table('turma_professor')->where('disciplina_id', $id)->get();     
    }




    
    foreach ($resultados as $turma) {
        $professores = DB::table('professores')->where('id', $turma->professor_id)->get();      
        foreach($professores as $professor){
          echo '<option value="'.$turma->professor_id.'">'.$professor->nome.'</option>';  
        }

   }   
})->name('get.professor');

