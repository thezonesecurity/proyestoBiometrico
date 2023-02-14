<div class="container-fluid">
    <div class="row">
        <div class="barra-lateral col-12 col-sm-auto">
            <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                <a href="{{ route('listar.servicio')}}"><i class="bi bi-border-style" style="font-size: 1.5rem;"></i><span>Servicios</span></a>
                <a href="#"><i class="bi bi-person-add" style="font-size: 1.5rem;"></i><span>Personal</span></a>
                <a href="#"><i class="bi bi-calendar2-plus" style="font-size: 1.5rem;"></i><span>Rol de turnos</span></a>
                <a href="#"><i class="bi bi-people" style="font-size: 1.5rem;"></i><span>cambio de turno</span></a>
                <a href="#"><i class="bi bi-calendar4-week" style="font-size: 1.5rem;"></i><span>Habilitacion de turnos</span></a>
                <a href="#"><i class="bi bi-table" style="font-size: 1.4rem;"></i><span>Reportes</span></a>
            </nav>
        </div>
        <main class="main col">
            <div class="row align-content-center ">
                <div class="columna col-lg-12">
                    <!--CONTENIDO-->
                    @yield('contenido')
                </div>
            </div>
        </main>
    </div>
</div>