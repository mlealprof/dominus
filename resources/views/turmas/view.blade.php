<x-layout title="Ver turma">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('turma.index')}}">Turmas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Ver turma {{$turma->id}}</li>
      </ol>
    </nav>
    {{$turma->id}}
    <br>
    {{$turma->nome}}

    {{$cursos}}
</x-layout>
