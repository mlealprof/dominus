<x-layout title="Editar Aluno">
    <form action="{{route('aluno.update',['aluno'=>$aluno])}}" method="post">
        @csrf
        @method('put')
        <div class="row g-3">

            <div class="col-sm-8">
                <label class="form-label">*Nome</label>
                <input type="text" class="form-control form-control-sm" id="nome" name="nome" required="" value="{{$aluno->nome}}">
            </div>

            <div class="col-sm-4">
                <label class="form-label">*Matricula</label>
                <input type="text" class="form-control form-control-sm" id="matricula" name="matricula" required="" value="{{$aluno->matricula}}">
            </div>

            <div class="col-6">
                <label class="form-label">*Email</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="voce@example.com" required="" value="{{ $aluno->email }}">
            </div>

            <div class="col-sm-2">
                <label class="form-label">*Data de Nascimento</label>
                <input type="text" class="form-control form-control-sm" id="nascimento" name="dataNascimento" placeholder="DD/MM/AAAA"
                    required="" value="{{$aluno->dataNascimento}}">
            </div>

            <div class="col-sm-4">

                <label class="form-label">*Sexo</label>
                <div class="container mt-1">
                    <div class="form-check form-check-inline">
                        @if($aluno->sexo == 'mas' )
                            <input class="form-check-input" type="radio" name="sexo" id="mas" value="mas" required="" checked="checked">
                        @else
                            <input class="form-check-input" type="radio" name="sexo" id="mas" value="mas" required="">
                        @endif
                            <label class="form-check-label">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        @if($aluno->sexo == 'fem' )
                            <input class="form-check-input" type="radio" name="sexo" id="fem" value="fem" required="" checked="checked">
                        @else
                            <input class="form-check-input" type="radio" name="sexo" id="fem" value="fem" required="">
                        @endif
                            <label class="form-check-label">Feminino</label>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <label class="form-label">*Celular</label>
                <input type="text" class="form-control form-control-sm" id="telefone" name="telefone"
                    placeholder="(00) 00000-0000" required="" value="{{ $aluno->telefone }}">
            </div>

            <div class="col-3">
                <label class="form-label">RG</label>
                <input type="text" class="form-control form-control-sm" id="rg" name="rg" placeholder="00.000.000-0" value="{{$aluno->rg}}">
            </div>

            <div class="col-sm-2">
                <label class="form-label">Estado Emissor</label>
                <select class="form-select form-select-sm" id="estado" name="estado" required="" value="{{ $aluno->estadoEmissor }}">

                    @foreach ($estados as $estado)
                        @if ($estado->uf == $aluno->estado)
                            <option selected value="{{$estado->uf}}">{{$estado->uf}}</option>
                        @endif
                        <option value="{{$estado->uf}}">{{$estado->uf}}</option>
                    @endforeach

                </select>
            </div>

            <div class="col-2">
                <label class="form-label">Órgão Emissor</label>
                <input type="text" class="form-control form-control-sm" id="orgaoEmissor" name="orgaoEmissor" value="{{ $aluno->orgaoEmissor }}">
            </div>

            <div class="col-sm-2">
                <label class="form-label">Data de expedição</label>
                <input type="text" class="form-control form-control-sm" id="expedicaoRg" name="dataExpedicao" placeholder="DD/MM/AAAA"
                    value="{{ $aluno->dataExpedicao }}">
            </div>

            <div class="col-5">
                <label class="form-label">Endereço</label>
                <input type="text" class="form-control form-control-sm" id="endereco" name="endereco" placeholder="Rua/AV" value="{{ $aluno->endereco }}">
            </div>

            <div class="col-sm-1">
                <label class="form-label">Numero</label>
                <input type="text" class="form-control form-control-sm" id="numero" name="numero" value="{{ $aluno->numero }}">
            </div>

            <div class="col-2">
                <label class="form-label">Complemento</label>
                <input type="text" class="form-control form-control-sm" id="complemento" name="complemento" value="{{ $aluno->complemento }}">
            </div>

            <div class="col-4">
                <label class="form-label">Bairro</label>
                <input type="text" class="form-control form-control-sm" id="bairro" name="bairro" value="{{ $aluno->bairro }}">
            </div>

            <div class="col-5">
                <label class="form-label">Cidade</label>
                <input type="text" class="form-control form-control-sm" id="cidade" name="cidade" value="{{ $aluno->cidade }}">
            </div>

            <div class="col-2">
                <label class="form-label">CEP</label>
                <input type="text" class="form-control form-control-sm" id="cep" name="cep"
                    placeholder="00000-000" value="{{ $aluno->cep }}">
            </div>

            <div class="col-sm-1">
                <label class="form-label">Estado</label>
                <select class="form-select form-select-sm" id="estado" name="estado" required="" value="{{ $aluno->estado }}">

                    @foreach ($estados as $estado)
                        @if ($estado->uf == $aluno->estado)
                            <option selected value="{{$estado->uf}}">{{$estado->uf}}</option>
                        @endif
                        <option value="{{$estado->uf}}">{{$estado->uf}}</option>
                    @endforeach

                </select>
            </div>

            <div class="row col-12 justify-content-end mb-3 mt-3">
                <button class="w-25 btn btn-outline-secondary" type="submit" onclick="window.history.back()">Voltar</button>
                <button class="w-25 btn btn-outline-primary ms-3" type="submit">Salvar</button>
            </div>
    </form>

</x-layout>
