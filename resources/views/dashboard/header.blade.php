<div class="container-fluid">
    <div class="row justify-content-center align-content-center">
        <div class="col-8 barra">
            <h4 class="text-light">Logo</h4>
        </div>
        <div class="col-4 text-right barra">
            <ul class="navbar-nav mr-auto">
                <li>
                    <!--
                    <a href="#" class="px-3 text-light perfil dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" 
                    aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-person-circle" style="font-size: 2rem; color: white;"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
                        <a class="dropdown-item menuperfil cerrar" href="#">
                            <i class="bi bi-person-circle">Salir</i>
                        </a>
                    </div><!-->
                    <div class="pull-right">
                        <a href="{{route('logout')}}" class="btn btn-danger btn-flat">Sign out</a>
                    </div>
                    
                </li>
            </ul>
        </div>
    </div>
</div>