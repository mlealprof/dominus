<style>
    .navs {
  display: block;
  padding: 0.5rem 1rem;
  color: rgba(0,43,55);
  text-decoration: none;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}
@media (prefers-reduced-motion: reduce) {
  .navs {
    transition: none;
  }
}
.navs:hover, .navs:focus {
  color: rgba(0,43,55,0.5);
}
.navs.disabled {
  color: #6c757d;
  pointer-events: none;
  cursor: default;
}
</style>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light border-end sidebar collapse ">
    <div class="position-sticky pt-3">
        <a href="/home" class="navs">
            <i class="fa fa-home fa-2x" aria-hidden="true"></i>
            Home
        </a>


        @if (session()->get('professor_id')=='')

        
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Cadastros</span>
        </h6>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="/professores" class="navs">
                    <img src="{{ asset('icons/professores.png') }}" style="width: 15%" />
                    Professor
                </a>
            </li>
            <li>
                <a href="/alunos" class="navs">
                    <img src="{{ asset('icons/aluno.png') }}" style="width: 15%" />
                    Aluno
                </a>
            </li>
            <li>
                <a href="/cursos" class="navs">
                    <img src="{{ asset('icons/cursos.png') }}" style="width: 15%" />
                    Curso
                </a>
            </li>
            <li>
                <a href="/turmas" class="navs">
                    <img src="{{ asset('icons/criancas.png') }}" style="width: 15%" />
                    Turma
                </a>
            </li>            
            <li>
                <a href="/modulos" class="navs">
                    <img src="{{ asset('icons/livro-didatico.png') }}" style="width: 15%" />
                    Módulo
            </a>
            </li>
            <li>
                <a href="/disciplinas" class="navs">
                    <img src="{{ asset('icons/livro.png') }}" style="width: 15%" />
                    Disciplina
                </a>
            </li>

            <li>
                <a href="/horarios" class="navs">
                    <img src="{{ asset('icons/tempo.png') }}" style="width: 15%" />
                    Horários
                </a>
            </li>
        </ul>

                
        @endif 



        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Lançamentos</span>
        </h6>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="/atividades" class="navs btn-sm">
                    <img src="{{ asset('icons/frequencia.png') }}" style="width: 15%" />
                    Atividades
                </a>
            </li>
            <li>
                <a href="/aulas" class="navs btn-sm">
                    <img src="{{ asset('icons/quadro-negro.png') }}" style="width: 15%" />
                    Aulas
                </a>
            </li>
     
            <li>
                <a href="/faltas_lote" class="navs btn-sm">
                    <img src="{{ asset('icons/presenca.png') }}" style="width: 15%" />
                    Faltas / Lote
                </a>
            </li>


        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Relatórios</span>
        </h6>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="/relatoriosfrequencia" class="navs btn-sm">
                    <img src="{{ asset('icons/presenca.png') }}" style="width: 15%" />
                    Frequência / Turma
                </a>
            </li>
            <li>
                <a href="/relatoriosaula" class="navs btn-sm">
                    <img src="{{ asset('icons/aulas.png') }}" style="width: 15%" />
                    Aulas Lançadas
                </a>
            </li>
            <li>
                <a href="/relatoriosnotas" class="navs btn-sm">
                    <img src="{{ asset('icons/notas.png') }}" style="width: 15%" />
                    Notas / Turma
                </a>
            </li>
            @if (session()->get('professor_id')=='')

            <li>
                <a href="/boletim" class="navs btn-sm">
                    <img src="{{ asset('icons/boletim.png') }}" style="width: 15%" />
                    Ficha Individual
                </a>            
            </li>
            @endif

        </ul>
        @if (session()->get('professor_id')=='')

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Acessos</span>
        </h6>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="/usuarios" class="navs btn-sm">
                    <img src="{{ asset('icons/cadastro_de_usuarios.png') }}" style="width: 15%" />
                    Cadastro de Usuário
                </a>
            </li>

        </ul>

        @endif
    </div>
</nav>
