<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Curso;
use App\Models\Modulo;
use App\Models\Aluno;
use App\Models\Professor;
use App\Models\TurmaAluno;
use App\Models\TurmaProfessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TurmaProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request, Turma $turma, TurmaProfessor $turmaProfessor)
     {
         $turmaProfessor->turma_id = $request->turma_id;
         $turmaProfessor->professor_id = $request->professor_id;
         $turmaProfessor->disciplina = $request->disciplina;
         $turmaProfessor->dia_semana = $request->dia_semana;
         $turmaProfessor->horario = $request->horario;
         $turmaProfessor->save();
         return redirect()->route('turma.professor.show', ['turma'=>$request->turma_id]);
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Turma $turma, TurmaProfessor $turmaProfessor, $id)
     {

         $deleted = DB::table('turma_professor')
             ->where('turma_id','=',$turma->id)
             ->where('id','=',$id)
             ->delete();
         return redirect()->route('turma.professor.show', ['turma'=>$turma->id]);
     }
}
