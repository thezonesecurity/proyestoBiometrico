<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>SARBHDB @section('titulo') @show</title>
    
    <link href="{{ asset("bootstrap4/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href={{ asset("alerts/toastr.min.css")}} rel="stylesheet" />
    <link href="{{ asset("bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet" type="text/css" />
    {{--<link href="{{ asset("datatables/jquery.dataTables.min.css")}}" rel="stylesheet" type="text/css" />NO USADO--}}
    <link href="{{ asset("assets/styles/style_plantilla.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("assets/styles/boxicons.min.css")}}" rel="stylesheet" type="text/css" />
    
    @section('styles') @show
</head>
<body>

     <!--INICIO SIDEBAR aqui barra lateral y contenido-->
    @include("dashboard/sidebar")

    <div class="home-section">
        <div class="home-content">
            <i class="bi bi-list" style="font-size: 2rem;"></i>  
            <span class="text">Menu</span>
        </div>
        <main class="main col">
            <div class="columnas">
                <!--CONTENIDO -->
                @yield('contenido')
            </div>
         </main>
    </div>

    {{--<script src="{{ asset("bootstrap4/jquery/jquery-3.5.1.slim.min.js")}}" type="text/javascript"></script>NO USADO--}}
    <script src="{{ asset("assets/scripts/plantilla.js")}}" type="text/javascript"></script>
    <script src="{{ asset("bootstrap4/jquery/jquery-3.3.1.min.js")}}" type="text/javascript"></script>
    {{--<script src="{{ asset("alerts/sweetalert.min.js")}}" type="text/javascript"></script> NO USADO--}} 
    <script src="{{ asset("alerts/toastr.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("bootstrap4/js/bootstrap.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("/bootstrap4/js/bootstrap.bundle.min.js")}}" type="text/javascript"></script> 
    <script type="text/javascript" src="{{ asset('assets/scripts/alert.js') }}"></script>

    @section('scripts') @show
</body>

</html>