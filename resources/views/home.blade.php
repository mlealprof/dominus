<x-layout title="Home">

 <h2 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Quadro de Avisos:</span>
  </h2>
 <form method="post" action="/quadro_aviso">
   <textarea cols="100" rows="10" name='aviso' id='aviso'>
  	
  </textarea>
  <br>
  <input type="submit" name="Salvar" Value='Salvar'>
 </form>


</x-layout>
