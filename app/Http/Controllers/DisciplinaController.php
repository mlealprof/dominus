<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;

class DisciplinaController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::query()->orderBy('id')->get();


        return view('disciplinas.index')
            ->with('disciplinas', $disciplinas);
    }

    public function store(Request $request)
    {

        $disciplina = new Disciplina();

        $disciplina->nome = $request->nome;
        $disciplina->sigla = $request->sigla;
        $disciplina->carga_horaria = $request->carga_horaria;
        $disciplina->save();
        return redirect('disciplinas');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disciplina $disciplina)
    {
        $disciplina->nome = $request->nome;
        $disciplina->sigla = $request->sigla;
        $disciplina->carga_horaria = $request->carga_horaria;
        $disciplina->save();
        return redirect('disciplinas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disciplina $disciplina)
    {
        $disciplina->delete();
        return redirect('disciplinas');
    }
}
