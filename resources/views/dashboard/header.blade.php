
<div class="container-fluid">
    <div class="row justify-content-center align-content-center">
        <div class="col-8 barra">
            <h4 class="text-light">Logo</h4>
        </div>
        <div class="col-4 text-right barra">
            <ul class="navbar-nav mr-auto">
                <div class="dropdown">
                    <?php $user= DB::select("SELECT P.* FROM public.users U, public.personas P WHERE P.id = U.persona_id AND U.email = '6543210'"); ?>
                        <span class="font-weight-bold text-white" >Bienvenido: {{$user[0]->nombres.' '.$user[0]->apellidos }} </span>
                    <a class="px-3 text-light dropdown-toggle perfil" id="dropdownMenuButton" role="button" data-toggle="dropdown"
                     aria-haspopup="true" aria-expanded="false">
                     <span></span>
                        <i class="bi bi-person-circle" style="font-size: 2rem; color: white;"></i>
                    </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item menuperfil cerrar" href="{{route('logout')}}">
                            <i class="bi bi-box-arrow-right" style="font-size: 1.5rem; margin-right: 20px;"></i>Salir
                        </a>
                    </div>
                  </div>  
            </ul>
        </div>
    </div>
</div>
