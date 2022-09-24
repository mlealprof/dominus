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
                    <img src="{{ asset('icons/alunos.png') }}" style="width: 15%" />
                    Aluno
                </a>
            </li>
            <li>
                <a href="/turmas" class="navs">
                    <img src="{{ asset('icons/classe.png') }}" style="width: 15%" />
                    Turma
                </a>
            </li>
            <li>
                <a href="/disciplinas" class="navs">
                    <img src="{{ asset('icons/disciplina.png') }}" style="width: 15%" />
                    Disciplina
                </a>
            </li>
            <li>
                <a href="/cursos" class="navs">
                    <img src="{{ asset('icons/cursos.png') }}" style="width: 15%" />
                    Curso
                </a>
            </li>
            <li>
                <a href="/modulos" class="navs">
                    <img src="{{ asset('icons/cursos.png') }}" style="width: 15%" />
                    Módulo
                </a>
            </li>
            <li>
                <a href="/horarios" class="navs">
                    <img src="{{ asset('icons/cursos.png') }}" style="width: 15%" />
                    Horários
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Lançamentos</span>
        </h6>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="" class="navs disabled btn-sm">
                    <img src="{{ asset('icons/notas.png') }}" style="width: 15%" />
                    Notas
                </a>
            </li>
            <li>
                <a href="" class="navs disabled btn-sm">
                    <img src="{{ asset('icons/frequencia.png') }}" style="width: 15%" />
                    Frequências
                </a>
            </li>
            <li>
                <a href="" class="navs disabled btn-sm">
                    <img src="{{ asset('icons/relatorios.png') }}" style="width: 15%" />
                    Relatórios
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Acessos</span>
        </h6>
        <ul class="nav nav-pills flex-column mb-auto">
            <li>
                <a href="" class="navs disabled btn-sm">
                    <img src="{{ asset('icons/cadastro_de_usuarios.png') }}" style="width: 15%" />
                    Cadastro de Usuário
                </a>
            </li>
            <li>
                <a href="" class="navs disabled btn-sm">
                    <img src="{{ asset('icons/grupo_de_usuarios.png') }}" style="width: 15%" />
                    Grupos de Usuários
                </a>
            </li>
        </ul>
    </div>
</nav>
