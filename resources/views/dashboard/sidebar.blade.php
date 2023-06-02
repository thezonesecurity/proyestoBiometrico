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
                    <i class="bi bi-clipboard-data"></i>
                    <span class="link_name">Reportes</span>
                </a>
                <i class="bi bi-caret-down arrow"></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Reportes</a></li>
                <li><a href="{{route('lista.reporte.rolturno')}}">Reportes 1</a></li>
                <li><a href="{{route('lista.reporte.rolturno.two')}}">Reportes 2</a></li>
                <li><a href="{{route('lista.reporte.rolturno.three')}}">Reportes 3</a></li>
            </ul>
        </li>
        {{--<li>
            <div class="profile-details">
                <div class="profile-content">
                    <img src="{{asset('assets/img/users.png')}}" alt="profileImg">
                </div>
                <div class="name-job">
                    <div class="profile_name">{{auth()->user()->per_user->nombres.' '.auth()->user()->per_user->apellidos }}</div>
                    <div class="job">Web Desginer</div>
                </div>
                <a href="{{route('logout')}}" class="logout">
                    <i class="bi bi-box-arrow-left" style="font-size: 2rem; color: rgb(222, 12, 12);" ></i>{{--style="font-size: 2rem; color: cornflowerblue;"--} }
                </a>
            </div>
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
                    <i class="bi bi-box-arrow-left" style="font-size: 2rem; color: rgb(222, 12, 12);" ></i>
                </a>
                <ul class="sub-menu">
                    {{--<li><a class="link_name" href="#">Administrar</a></li>--}}
                    <span class="" style="margin: -17px; font-size: 14px; color: white">Cerrar Sesion</span>
                    <li><a href="{{route('logout')}}" class="iconlogout">
                        <i class="bi bi-box-arrow-left" style="margin-top: -15px; font-size: 2rem; color: red; " ></i>    
                    </a></li>
                </ul>
            </div>             
        </li>
    </ul>
</div>