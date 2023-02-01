<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scaleble=no, initial-scale=1.0 maximun-scale=1.0, minimun-scale=1.0" >
     <!-- Seccion estilos -->
     <link rel="stylesheet" href="{{ asset("bootstrap3/styles/stylelogin.css")}}"> <!-- href="{ asset('styles/stylelogin.css') }}">-->
     <link rel="stylesheet" href="{{ asset("bootstrap3/css/bootstrap.min.css")}}"> <!-- "{ asset('css/bootstrap.min.css') }}"> ------>
    <!-- Fin Seccion estilos jumbotron -->
    <title>Document</title>
</head>
<body class="bg-info">
    
    <div class="container" >
            <div class="boxlogin">
                <form method="POST" action="{{ route('login_post') }}"  name="flogin" id="flogin" class="border p-3 form" autocomplete="off" >
                   @csrf
                    <div class="img-responsive ">
                        <img class="imagelogin" src="{{ asset('bootstrap3/img/hdb2.jfif') }}" >
                    </div>
                    <h3 class="text-center fw-bold">Sing In</h3>
                    <div class="form-group ">
                        <div class="input-group">
                            <label class="sr-only" for="correo">{{ __('Usuario') }}</label>
                        <div class="glyphicon glyphicon-user input-group-addon"></div>
                            <input id="email" type="number" class="form-control" name="email" 
                            value="{{ old('email') }}" required autofocus placeholder="Numero de Usuario">                
                        </div>
                    <div>
                    <br>
                    <div class="form-group">
                            <div class="input-group">
                                <label class="sr-only" >{{ __('Password') }} </label>
                            <div class="input-group-addon glyphicon glyphicon-log-in"></div>
                            <input id="password" type="password" class="form-control"
                            name="password" required  placeholder="Password">          
                        </div>
                    </div>
                    <div class="">
                        <input type="submit" class="btn btn-success form-control" value="Conectarse">
                    </div>
                </form>
                <br>
                <!--para mesaje de alerta error de credenciales-->
                @if ($errors -> any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <div class="alert-text">
                        @foreach ($errors->all() as $error)
                         <span>{{ $error}}</span>
                        @endforeach
                    </div>
                </div>
                @endif
                <!--fin-->
            </div>
        </div>
    </div>
</body>
</html>




<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scaleble=no, initial-scale=1.0 maximun-scale=1.0, minimun-scale=1.0" >
     <-- Seccion estilos --
     <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
     <link rel="stylesheet" href="{{ asset('styles/stylelogin.css') }}">
    <-- Fin Seccion estilos jumbotron --
    <title>Document</title>
</head>
<body class="bg-info">
    
    <div class="container " >
            <div class="boxlogin">
                <form method="POST" name="flogin" id="flogin"action="" class="border p-3 form " >
                    <div class="img-responsive ">
                        <img class="imagelogin" src="{{ asset('img/hdb2.jfif') }}" >
                    </div>
                    <h3 class="text-center fw-bold">Sing In</h3>
                    <div class="form-group ">
                        <div class="input-group">
                            <label class="sr-only" for="correo">Usuario: </label>
                        <div class=" glyphicon glyphicon-user input-group-addon"></div>
                            <input type="text" class="form-control " id="username" placeholder="Username">                
                        </div>
                    <br>
                    <div>
                    <div class="form-group">
                            <div class="input-group">
                                <label class="sr-only" for="correo">Usuario: </label>
                            <div class="input-group-addon glyphicon glyphicon-log-in"></div>
                            <input type="password" class="form-control" id="password" placeholder="Password">                
                        </div>
                    </div>
                    <div class="">
                        <input type="checkbox" value="lsRememberMe" id="rememberMe">
                        <label for="rememberMe">Remember me</label> 
                    </div>
                    <div class="">
                        <input type="submit" class="btn btn-success form-control" value="Conectarse">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>





inputs anteriores

 <div class="form-group ">
                        <div class="input-group">
                            <label class="sr-only" for="correo">{{ __('Usuario') }}</label>
                        <div class=" glyphicon glyphicon-user input-group-addon"></div>
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" 
                            value="{{ old('email') }}" required autofocus placeholder="Numero de Usuario">                
                        </div>
                    <div>
                    <br>
                    <div class="form-group">
                            <div class="input-group">
                                <label class="sr-only" >{{ __('Password') }} </label>
                            <div class="input-group-addon glyphicon glyphicon-log-in"></div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" required  placeholder="Password">          
                        </div>
                    </div>
-->