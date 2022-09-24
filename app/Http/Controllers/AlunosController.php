<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Estado;
use Illuminate\Http\Request;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::query()->orderBy('nome')->get();
        return view('alunos.index')->with('alunos', $alunos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = Estado::query()->orderBy('id')->get();
        return view('alunos.create')->with('estados', $estados);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aluno = new Aluno();
        $aluno->matricula = $request->matricula;
        $aluno->nome = $request->nome;
        $aluno->dataNascimento = $request->dataNascimento;
        $aluno->sexo = $request->sexo;
        $aluno->rg = $request->rg;
        $aluno->estadoEmissor = $request->estadoEmissor;
        $aluno->orgaoEmissor = $request->orgaoEmissor;
        $aluno->dataExpedicao = $request->dataExpedicao;
        $aluno->telefone = $request->telefone;
        $aluno->email = $request->email;
        $aluno->endereco = $request->endereco;
        $aluno->numero = $request->numero;
        $aluno->complemento = $request->complemento;
        $aluno->bairro = $request->bairro;
        $aluno->cep = $request->cep;
        $aluno->cidade = $request->cidade;
        $aluno->estado = $request->estado;
        $aluno->save();

        return redirect('alunos');
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
    public function edit(Aluno $aluno)
    {
        $estados = Estado::query()->orderBy('id')->get();
        //$professor = Professor::findOrFail($id);
        return view('alunos.edit',[
            'estados' => $estados,
            'aluno' => $aluno
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aluno $aluno)
    {

        $aluno->matricula = $request->matricula;
        $aluno->nome = $request->nome;
        $aluno->dataNascimento = $request->dataNascimento;
        $aluno->sexo = $request->sexo;
        $aluno->rg = $request->rg;
        $aluno->estadoEmissor = $request->estadoEmissor;
        $aluno->orgaoEmissor = $request->orgaoEmissor;
        $aluno->dataExpedicao = $request->dataExpedicao;
        $aluno->telefone = $request->telefone;
        $aluno->email = $request->email;
        $aluno->endereco = $request->endereco;
        $aluno->numero = $request->numero;
        $aluno->complemento = $request->complemento;
        $aluno->bairro = $request->bairro;
        $aluno->cep = $request->cep;
        $aluno->cidade = $request->cidade;
        $aluno->estado = $request->estado;
        $aluno->save();

        return redirect('alunos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return redirect('alunos');
    }
}
