<x-layout title="Editar Professor">
    <form action="{{route('professor.update',['professor'=>$professor])}}" method="post">
        @csrf
        @method('put')
        <div class="row g-3 ">
            <div class="col-sm-8">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control form-control-sm" id="nome" name="nome" required="" value="{{ $professor->nome }}">
            </div>

            <div class="col-sm-4">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control form-control-sm" id="cpf" name="cpf"
                    placeholder="000.000.000-00" required="" value="{{ $professor->cpf }}">
            </div>

            <div class="col-sm-5">
                <label class="form-label">Email</label>
                <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="voce@example.com" required="" value="{{ $professor->email }}">
            </div>

            <div class="col-sm-3">
                <label class="form-label">Celular</label>
                <input type="text" class="form-control form-control-sm"
                    id="celular" name="celular" placeholder="(00) 00000-0000" required="" value="{{ $professor->celular }}">
            </div>

            <div class="col-sm-5">
                <label class="form-label">Endereço</label>
                <input type="text" class="form-control form-control-sm" id="endereco" name="endereco" placeholder="Rua/AV" required="" value="{{ $professor->endereco }}">
            </div>

            <div class="col-sm-1">
                <label class="form-label">Numero</label>
                <input type="text" class="form-control form-control-sm" id="numero" name="numero" required="" value="{{ $professor->numero }}">
            </div>

            <div class="col-sm-2">
                <label class="form-label">Complemento</label>
                <input type="text" class="form-control form-control-sm" id="complemento" name="complemento" value="{{ $professor->complemento }}">
            </div>

            <div class="col-sm-4">
                <label class="form-label">Bairro</label>
                <input type="text" class="form-control form-control-sm" id="bairro" name="bairro" required="" value="{{ $professor->bairro }}">
            </div>



            <div class="col-sm-5">
                <label class="form-label">Cidade</label>
                <input type="text" class="form-control form-control-sm" id="cidade" name="cidade" required="" value="{{ $professor->cidade }}">
            </div>

            <div class="col-sm-2">
                <label class="form-label">CEP</label>
                <input type="text" class="form-control form-control-sm" id="cep" placeholder="00000-000"
                    name="cep" required="" value="{{ $professor->cep }}">
            </div>

            <div class="col-sm-1">
                <label class="form-label">Estado</label>
                <select class="form-select form-select-sm" id="estado" name="estado" required="" value="{{ $professor->estado }}">

                    @foreach ($estados as $estado)
                        @if ($estado->uf == $professor->estado)
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
        </div>
    </form>
</x-layout>
