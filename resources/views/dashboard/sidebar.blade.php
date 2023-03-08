<div class="container-fluid">
    <div class="row">
        <div class="barra-lateral col-12 col-sm-auto">
            <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                <a href="{{route('listar.servicio')}}">
                    <i class="bi bi-border-style"></i>
                    <span>Servicios</span>
                </a>
                <a href="{{route('listar.personal')}}">
                    <i class="bi bi-person-add"></i>
                    <span>Personal</span>
                </a>
                <a href="#">
                    <i class="bi bi-calendar2-plus">
                        </i><span>Rol de turnos</span>
                </a>
                <a href="#">
                    <i class="bi bi-people"></i>
                    <span>cambio de turno</span>
                </a>
                <a href="#">
                    <i class="bi bi-calendar4-week"></i>
                    <span>Habilitacion de turnos</span>
                </a>
                <a href="{{route('tabla')}}">
                    <i class="bi bi-table"></i>
                    <span>Reportes</span>
                </a>
            </nav>
        </div>
        <main class="main col">
            <div class="row align-content-center">
                <div class="columnas ">
                    <!--CONTENIDO col-lg-6 -->
                    @yield('contenido')
                </div>
            </div>
        </main>
    </div>
</div>