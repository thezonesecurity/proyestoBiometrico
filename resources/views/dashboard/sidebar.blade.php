<div class="container-fluid">
    <div class="row">
        <div class="barra-lateral col-12 col-sm-auto">
            <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                <a href="{{route('listar.servicio')}}" title="Servicios">
                    <i class="bi bi-border-style"></i>
                    <span>Servicios</span>
                </a>
                <a href="{{route('listar.area.servicio')}}" title="Areas de los Servicios">
                    <i class="bi bi-boxes"></i>
                    <span>Areas de servicios</span>
                </a>
                <a href="{{route('listar.personal')}}" title="Personas">
                    <i class="bi bi-person-add"></i>
                    <span>Personal</span>
                </a>
                <a href="{{route('listar.tipos.turnos')}}" title="Lista de tipo de turnos">
                    <i class="bi bi-journals"></i>
                    <span>Tipo de turnos</span>
                </a>
                <a href="{{route('listar.tipos.contratos')}}" title="Lista de tipos de contratos">
                    <i class="bi bi-person-vcard"></i>
                    <span>Tipo de Contratos</span>
                </a>
                <a href="{{route('listar.registrar.rolturno')}}" title="Rol Rurnos">
                    <i class="bi bi-calendar2-plus"></i>
                    <span>Rol de turnos</span>
                </a>
                <a href="{{route('listar.roles.turno')}}" title="Lista de rol de turnos">
                    <i class="bi bi-building"></i>
                    <span>Lista de rol de turnos</span>
                </a>
                {{--{{route('listar.cambio_turno')}}--}
                    <a href="{{route('tabla')}}" title="Cambio de Turno">
                    <i class="bi bi-people"></i>
                    <span>tabla</span>
                </a>--}}
                <a href="{{route('habilitar.rolturno')}}" title="Habilitacion de Rolturnos">
                    <i class="bi bi-calendar4-week"></i>
                    <span>Habilitacion de turnos</span>
                </a>
                <a href="{{route('tabla')}}" title="Reportes" >
                    <i class="bi bi-table"></i>
                    <span>Reportes</span>
                </a>
            </nav>
        </div>
        <main class="main col">
            <div class="columnas">
                <!--CONTENIDO col-lg-6 -->
                @yield('contenido')
            </div>
        </main>
    </div>
</div>