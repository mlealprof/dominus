<x-layout title="Avisos">

<hr>
 @if(session()->get('professor_id')=='')
     <form method="post" action="/quadro_aviso">
      @csrf  
       <textarea cols="100" rows="10" name='conteudo' id='conteudo'>
      	@foreach ($aviso as $lista_item)
          @php
            echo $lista_item;
          @endphp
        @endforeach
      </textarea>
      <br>
      <input type="submit" name="Salvar" Value='Salvar'>
     </form>
  @else
     @foreach ($aviso as $lista_item)
        @php
          echo $lista_item.'<br/>';
        @endphp
     @endforeach

        
  @endif


</x-layout>
