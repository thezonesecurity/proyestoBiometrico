<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SARB @section('titulo') @show</title>
    
    <link href="{{ asset("bootstrap4/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("bootstrap4/style/dashboard.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet" type="text/css" />
    @section('styles') @show
</head>
<body>
    <!--INICIO HEADER include se situa en views--> 
    @include("dashboard/header")
    <!--FIN HEADER-->

    <!--INICIO SIDEBAR aqui barra lateral y contenido--> 
    @include("dashboard/sidebar")
    <!--FIN SIDEBAR-->

    <script src="{{ asset("bootstrap4/jquery/jquery-3.5.1.slim.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("bootstrap4/js/bootstrap.min.js")}}" type="text/javascript"></script> 
    <script src="{{ asset("/bootstrap4/js/bootstrap.bundle.min.js")}}" type="text/javascript"></script> 
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    @section('scripts') @show
</body>

</html>