<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SARBHDB @section('titulo') @show</title>
    
    <link href="{{ asset("bootstrap4/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href={{ asset("alerts/toastr.min.css")}} rel="stylesheet" />
    {{--<link href="{{ asset("bootstrap4/style/dashboard.css")}}" rel="stylesheet" type="text/css" />--}}
    <link href="{{ asset("bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet" type="text/css" />
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap4/css/select2/select2.css') }}">--}}
    <link href="{{ asset("datatables/jquery.dataTables.min.css")}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset("assets/styles/style_plantilla.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/styles/boxicons.min.css")}}" rel="stylesheet" type="text/css" />
    @section('styles') @show
</head>
<body>
    <div class="sidebar close">
        <div class="logo-details">
            <a href="{{route('inicio')}}" class="logo">
                <i class="bi bi-house-door"></i>{{-- style="font-size: 1rem;"--}}
            </a>
            <span class="logo_name">S.A.R.B.H.D.B.</span>
        </div>
        <ul class="nav-links">
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="bi bi-calendar2-check"></i>
                        <span class="link_name">Rolturnos</span>
                    </a>
                    <i class="bi bi-caret-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Rolturnos</a></li>
                    <li><a href="{{route('listar.tipos.turnos')}}">Lista tipo de turnos</a></li>
                    <li><a href="{{route('listar.registrar.rolturno')}}">Crear rol de turnos</a></li>
                    <li><a href="{{route('listar.roles.turno')}}">Lista de rol turnos</a></li>
                    <li><a href="{{route('habilitar.rolturno')}}">Habilitacion de turnos</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="bi bi-journals"></i>
                        <span class="link_name">Administrar</span>
                    </a>
                    <i class="bi bi-caret-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Administrar</a></li>
                    <li><a href="{{route('listar.servicio')}}">Lista de servicios</a></li>
                    <li><a href="{{route('listar.area.servicio')}}">Lista de areas</a></li>
                    <li><a href="{{route('listar.tipos.contratos')}}">Lista tipo de contratos</a></li>
                    <li><a href="{{route('listar.personal')}}">Lista de personas</a></li>
                </ul>
            </li>
            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="bi bi-clipboard-data"></i>
                        <span class="link_name">Reportes</span>
                    </a>
                    <i class="bi bi-caret-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="#">Reportes</a></li>
                    <li><a href="{{route('primer.reporte.rolturno')}}">Reportes 1</a></li>
                    <li><a href="#">Reportes 2</a></li>
                    <li><a href="#">Reportes 3</a></li>
                </ul>
            </li>
            {{--<li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2' ></i>
                    <span class="link_name">Analytics</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Analytics</a></li>
                </ul>
            </li>--}}
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="{{asset('assets/img/users.png')}}" alt="profileImg">
                    </div>
                    <div class="name-job">
                        <div class="profile_name">{{auth()->user()->per_user->nombres.' '.auth()->user()->per_user->apellidos }}</div>
                        <div class="job">Web Desginer</div>
                    </div>
                    <a href="{{route('logout')}}" class="logout">
                        <i class="bi bi-box-arrow-left" style="font-size: 2rem; color: rgb(222, 12, 12);" ></i>{{--style="font-size: 2rem; color: cornflowerblue;"--}}
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <div class="home-section">
        <div class="home-content">
            <i class="bi bi-list" style="font-size: 2rem;"></i>  
            <span class="text">Menu</span>
        </div>
        <main class="main col">
            <div class="columnas">
                <!--CONTENIDO col-lg-6 -->
                @yield('contenido')
            </div>
         </main>
    </div>

    <!--INICIO HEADER include se situa en views
    include("dashboard/header")--> 
    <!--FIN HEADER-->

    <!--INICIO SIDEBAR aqui barra lateral y contenido
    include("dashboard/sidebar")--> 
    <!--FIN SIDEBAR-->

    {{--<script src="{{ asset("bootstrap4/jquery/jquery-3.5.1.slim.min.js")}}" type="text/javascript"></script>--}}
    <script src="{{ asset("assets/scripts/plantilla.js")}}" type="text/javascript"></script>
    <script src="{{ asset("bootstrap4/jquery/jquery-3.3.1.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("alerts/sweetalert.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("alerts/toastr.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("bootstrap4/js/popper.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("bootstrap4/js/bootstrap.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("/bootstrap4/js/bootstrap.bundle.min.js")}}" type="text/javascript"></script> 
    {{--<script type="text/javascript" src="{{ asset('bootstrap4/js/select2/select2.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('assets/scripts/alert.js') }}"></script>

    @section('scripts') @show
</body>

</html>