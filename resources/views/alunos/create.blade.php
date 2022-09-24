<x-layout title="Novo Aluno">
    <form class="needs-validation" action="{{ route('aluno.store') }}" method="post">
        @csrf
        <div class="row g-3">

            <div class="col-sm-8">
                <label class="form-label">*Nome</label>
                <input type="text" class="form-control form-control-sm" id="nome" name="nome" required="">
            </div>

            <div class="col-sm-4">
                <label class="form-label">*Matricula</label>
                <input type="text" class="form-control form-control-sm" id="matricula" name="matricula" required="">
            </div>

            <div class="col-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control form-control-sm"  id="email" name="email" placeholder="voce@example.com">
            </div>



            <div class="col-sm-2">
                <label class="form-label">Data de Nascimento</label>
                <input type="text" class="form-control form-control-sm"  id="nascimento" name="dataNascimento" placeholder="DD/MM/AAAA"
                >
            </div>

            <div class="col-sm-4">
                <label class="form-label">*Sexo</label>
                <div class="container mt-1">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="mas" value="mas" required="">
                        <label class="form-check-label">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="fem" value="fem" required="">
                        <label class="form-check-label">Feminino</label>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <label class="form-label">Celular</label>
                <input type="text" class="form-control form-control-sm"  id="telefone" name="telefone"
                    placeholder="(00) 00000-0000">
            </div>

            <div class="col-3">
                <label class="form-label">RG</label>
                <input type="text" class="form-control form-control-sm"  id="rg" name="rg" placeholder="00.000.000-0">
            </div>

            <div class="col-md-2">
                <label class="form-label">Estado Emissor</label>
                <select class="form-select form-select-sm" id="estadoEmissor"  name="estadoEmissor">
                    @foreach ($estados as $estado)
                        <option value="{{ $estado->uf }}">{{ $estado->uf }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-2">
                <label class="form-label">Órgão Emissor</label>
                <input type="text" class="form-control form-control-sm" id="orgaoEmissor" name="orgaoEmissor">
            </div>

            <div class="col-sm-2">
                <label class="form-label">Data de expedição</label>
                <input type="text" class="form-control form-control-sm"  id="expedicaoRg" name="dataExpedicao" placeholder="DD/MM/AAAA"
                    >
            </div>

            <div class="col-5">
                <label class="form-label">Endereço</label>
                <input type="text" class="form-control form-control-sm" id="endereco" name="endereco" placeholder="Rua/AV">
            </div>

            <div class="col-sm-1">
                <label class="form-label">Numero</label>
                <input type="text" class="form-control form-control-sm" id="numero" name="numero">
            </div>

            <div class="col-2">
                <label class="form-label">Complemento</label>
                <input type="text" class="form-control form-control-sm"  id="complemento" name="complemento">
            </div>

            <div class="col-4">
                <label class="form-label">Bairro</label>
                <input type="text" class="form-control form-control-sm" id="bairro" name="bairro" >
            </div>

            <div class="col-sm-5">
                <label class="form-label">Cidade</label>
                <input type="text" class="form-control form-control-sm"  id="cidade" name="cidade">
            </div>

            <div class="col-sm-2">
                <label class="form-label">CEP</label>
                <input type="text" class="form-control form-control-sm"  id="cep" placeholder="00000-000"
                    name="cep">
            </div>

            <div class="col-sm-1">
                <label class="form-label">Estado</label>
                <select class="form-select form-select-sm" id="estado"  name="estado" value="">

                    @foreach ($estados as $estado)
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
