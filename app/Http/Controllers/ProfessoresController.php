<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Estado;
use Illuminate\Http\Request;

class ProfessoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professores = Professor::query()->orderBy('nome')->get();
        return view('professores.index')->with('professores', $professores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::query()->orderBy('id')->get();
        return view('professores.create')->with('estados', $estados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $professor = new Professor();

        $professor->nome = $request->nome;
        $professor->cpf = $request->cpf;
        $professor->email = $request->email;
        $professor->celular = $request->celular;
        $professor->cep = $request->cep;
        $professor->endereco = $request->endereco;
        $professor->numero = $request->numero;
        $professor->complemento = $request->complemento;
        $professor->bairro = $request->bairro;
        $professor->cidade = $request->cidade;
        $professor->estado = $request->estado;
        $professor->save();

        return redirect('professores');
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
    public function edit(Professor $professor)
    {
        $estados = Estado::query()->orderBy('id')->get();
        //$professor = Professor::findOrFail($id);
        return view('professores.edit',[
            'estados' => $estados,
            'professor' => $professor
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Professor $professor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Professor $professor)
    {
        $professor->nome = $request->nome;
        $professor->cpf = $request->cpf;
        $professor->email = $request->email;
        $professor->celular = $request->celular;
        $professor->cep = $request->cep;
        $professor->endereco = $request->endereco;
        $professor->numero = $request->numero;
        $professor->complemento = $request->complemento;
        $professor->bairro = $request->bairro;
        $professor->cidade = $request->cidade;
        $professor->estado = $request->estado;
        $professor->save();

        return redirect('professores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Professor $professor)
    {
        $professor->delete();
        return redirect('professores');
    }
}
