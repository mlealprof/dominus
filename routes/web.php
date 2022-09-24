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



//Autocomplete
Route::get('/getmodulo/{id}', function ($id) {
    $result = DB::table('modulos')->where('curso_id', $id)->get();
    echo '<option value="0">Selecione...</option>';
    foreach ($result as $modulo) {
        echo '<option value="'.$modulo->id .'">' .$modulo->nome.'</option>';
    }
})->name('get.modulo');
