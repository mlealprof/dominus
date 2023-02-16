<x-layout title="Novo Usuário">

@if ($professor_id=='')
<form class="needs-validation"  action="{{ route('usuarios.create') }}" method="get">
       @csrf
       <div class="row g-3">
           <div class="col-sm-5">
           
              <input type="text" name="search" id="search" class="form-control" placeholder="Buscar Professor">
            </div>  
               <div class="col-3 align-self-end">
                   <button class="btn btn-outline-primary btn-store" type="submit">Buscar Professor</button>
               </div>              
          
        </div>
  </form>
  <br><hr>
   @if ($search)
    <form class="needs-validation" action="" method="get">
        @csrf
        <div class="row g-3">            
            <div class="col-sm-5">          
                <label class="form-label">Resultado buscando por: {{ $search }}</label>
                <select class="form-select" id="professor_id" name="professor_id">
                    <option value="0">Selecione...</option>
                    @foreach ($professores as $prof)
                        <option value="{{$prof->id}}">{{$prof->cpf}} - {{$prof->nome}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-3 align-self-end">
                <button class="btn btn-outline-primary btn-store" type="submit">Adicionar Professor</button>
            </div>
        </div>
    </form>
    @endif
    <br><br><hr>
   @endif
    <form action="{{ route('usuario.store') }}" method="get">
        @csrf

        @if ($professor_id<>'')

             <h3>{{$professores->cpf}}-{{$professores->nome}}</h3>
             <input type="hidden" name="nome" value="{{$professores->nome}}">
             <input type="hidden" name="professor_id" value="{{$professores->id}}">

        @endif

        <div class="row g-3 ">


            <div class="col-sm-4">
                <label class="form-label">CPF</label>
                <input type="text" class="form-control form-control-sm" id="cpf" name="cpf"
                    placeholder="Somente Número" required="">
            </div>

            <div class="col-sm-2">
                <label class="form-label">Senha</label>
                <input type="password" class="form-control form-control-sm" id="senha" placeholder="******"
                    name="senha" required="">
            </div>


            <div class="row col-12 justify-content-end mb-3 mt-3">
                <button class="w-25 btn btn-outline-secondary" type="submit" onclick="window.history.back()">Voltar</button>
                <button class="w-25 btn btn-outline-primary ms-3" type="submit">Salvar</button>
            </div>
        </div>
    </form>
</x-layout>
