<div class="container-fluid">
    <div class="row">
        <div class="barra-lateral col-12 col-sm-auto">
            <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                <a href="{{route('listar.servicio')}}" title="Listar Servicios">
                    <i class="bi bi-border-style"></i>
                    <span>Lista Servicios</span>
                </a>
                <a href="{{route('listar.area.servicio')}}" title="Listar Areas de los Servicios">
                    <i class="bi bi-boxes"></i>
                    <span>Lista Areas de servicios</span>
                </a>
                <a href="{{route('listar.personal')}}" title="Administrar Personas">
                    <i class="bi bi-person-add"></i>
                    <span>Administrar Personal</span>
                </a>
                <a href="{{route('listar.tipos.turnos')}}" title="Lista de tipo de turnos">
                    <i class="bi bi-journals"></i>
                    <span>Lista Tipo de turnos</span>
                </a>
                <a href="{{route('listar.tipos.contratos')}}" title="Lista de tipos de contratos">
                    <i class="bi bi-person-vcard"></i>
                    <span>Lista Tipo de Contratos</span>
                </a>
                <a href="{{route('listar.registrar.rolturno')}}" title="Crear Rol Rurnos">
                    <i class="bi bi-calendar2-plus"></i>
                    <span>Crear Rol de turnos</span>
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
                    <span>Lista Habilitacion de turnos</span>
                </a>
                <a href="{{route('tabla')}}" title="Reportes" >
                    <i class="bi bi-table"></i>
                    <span>Reportes</span>
                </a>
                {{----}}
                <div >
                    <li class="dropdown_list">
                        <a href="#" class="dropdown_link">
                            <i class="bi bi-border-style dropdown_icon"></i>
                            <span class="dropdown_span">Inicio</span>
                            
                            <input type="checkbox" class="dropdown_check">
                            <i class="bi bi-caret-down dropdown_arrow"></i>
                        </a>

                        <div class="dropdown_content">
                            <ul class="dropdown_sub">
                                <li class="dropdown_li">
                                    <i class="bi bi-boxes"></i>
                                    <a href="#" class="dropdown_anchor">MENU 1</a>
                                </li>
                                <li class="dropdown_li">
                                    <i class="bi bi-boxes"></i>
                                    <a href="#" class="dropdown_anchor">MENU 2</a>
                                </li>
                                <li class="dropdown_li">
                                    <i class="bi bi-boxes"></i>
                                    <a href="#" class="dropdown_anchor">MENU 3</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </div>
                {{----}}
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


{{--
<div class="container-fluid">
    <div class="row">
        <div class="barra-lateral col-12 col-sm-auto">
            <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                <a href="{{route('listar.servicio')}}" title="Listar Servicios">
                    <i class="bi bi-border-style"></i>
                    <span>Lista Servicios</span>
                </a>
                <a href="{{route('listar.area.servicio')}}" title="Listar Areas de los Servicios">
                    <i class="bi bi-boxes"></i>
                    <span>Lista Areas de servicios</span>
                </a>
                <a href="{{route('listar.personal')}}" title="Administrar Personas">
                    <i class="bi bi-person-add"></i>
                    <span>Administrar Personal</span>
                </a>
                <a href="{{route('listar.tipos.turnos')}}" title="Lista de tipo de turnos">
                    <i class="bi bi-journals"></i>
                    <span>Lista Tipo de turnos</span>
                </a>
                <a href="{{route('listar.tipos.contratos')}}" title="Lista de tipos de contratos">
                    <i class="bi bi-person-vcard"></i>
                    <span>Lista Tipo de Contratos</span>
                </a>
                <a href="{{route('listar.registrar.rolturno')}}" title="Crear Rol Rurnos">
                    <i class="bi bi-calendar2-plus"></i>
                    <span>Crear Rol de turnos</span>
                </a>
                <a href="{{route('listar.roles.turno')}}" title="Lista de rol de turnos">
                    <i class="bi bi-building"></i>
                    <span>Lista de rol de turnos</span>
                </a>
                {{--{{route('listar.cambio_turno')}}--}
                    <a href="{{route('tabla')}}" title="Cambio de Turno">
                    <i class="bi bi-people"></i>
                    <span>tabla</span>
                </a>--}
                <a href="{{route('habilitar.rolturno')}}" title="Habilitacion de Rolturnos">
                    <i class="bi bi-calendar4-week"></i>
                    <span>Lista Habilitacion de turnos</span>
                </a>
                <a href="{{route('tabla')}}" title="Reportes" >
                    <i class="bi bi-table"></i>
                    <span>Reportes</span>
                </a>
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Dropdown link
                    </a>
                  
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <ul>
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li> <a class="dropdown-item" href="#">Another action</a></li>
                            <li> <a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                  </div>
                  
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

--}}