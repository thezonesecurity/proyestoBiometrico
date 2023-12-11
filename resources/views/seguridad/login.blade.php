<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Seccion estilos -->
     <link href="{{ asset("bootstrap-icons/bootstrap-icons.css")}}" rel="stylesheet" type="text/css" />
     <link href="{{ asset("bootstrap4/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
     <style media="screen">
*{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
}
body{
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}
.wave{
	position: fixed;
	bottom: 0;
	left: 0;
	height: 100%;
	z-index: -1;
}
.container{
    width: 100vw;
    height: 100vh;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap :7rem;
    padding: 0 2rem;
}
.img{
	display: flex;
	justify-content: flex-end;
	align-items: center;
}
.login-content{
	display: flex;
	justify-content: flex-start;
	align-items: center;
	text-align: center;
	background-color:rgba(162, 168, 188, 0.468);
	margin: 150px auto;
    padding-left: 40px;
	padding-right: 40px;
	border-radius: 25px;
}
.img img{
	width: 500px;
}
form{
	width: 360px;
}
.login-content img{
    height: 100px;
}
.login-content h2{
	margin: 15px 0;
	color: #333;
	text-transform: uppercase;
	font-size: 2.9rem;
}
.login-content .input-div{
	position: relative;
    display: grid;
    grid-template-columns: 7% 93%;
    margin: 25px 0;
    padding: 5px 0;
    border-bottom: 2px solid #ffffff;
}
.login-content .input-div.one{
	margin-top: 0;
}
.i{
	color: #d9d9d9;
	display: flex;
	justify-content: center;
	align-items: center;
}
.i i{
	transition: .3s;
}
.input-div > div{
    position: relative;
	height: 45px;
}
.input-div > div > h5{
	position: absolute;
	left: 10px;
	top: 50%;
	transform: translateY(-50%);
	color: #454040;
	font-size: 18px;
	transition: .3s;
}
.input-div:before, .input-div:after{
	content: '';
	position: absolute;
	bottom: -2px;
	width: 0%;
	height: 2px;
	background-color: #38d39f;
	transition: .4s;
}
.input-div:before{
	right: 50%;
}
.input-div:after{
	left: 50%;
}
.input-div.focus:before, .input-div.focus:after{
	width: 50%;
}
.input-div.focus > div > h5{
	top: -5px;
	font-size: 15px;
}
.input-div.focus > .i > i{
	color: #38d39f;
}
.input-div > div > input{
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	border: none;
	outline: none;
	background: none;
	padding: 0.5rem 0.7rem;
	font-size: 1.2rem;
	color: #555;
	font-family: 'poppins', sans-serif;
}
.input-div.pass{
	margin-bottom: 4px;
}

.btn{
	display: block;
	width: 100%;
	height: 50px;
	border-radius: 25px;
	outline: none;
	border: none;
	background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
	background-size: 200%;
	font-size: 1.2rem;
	color: #fff;
	font-family: 'Poppins', sans-serif;
	text-transform: uppercase;
	margin: 1rem 0;
	cursor: pointer;
	transition: .5s;
    margin-top: 30px;
}
.btn:hover{
	background-position: right;
}

@media screen and (max-width: 1050px){
	.container{
		grid-gap: 5rem;
	}
}

@media screen and (max-width: 1000px){
	form{
		width: 290px;
	}
	.login-content h2{
        font-size: 2.4rem;
        margin: 8px 0;
	}
	.img img{
		width: 400px;
	}
}

@media screen and (max-width: 900px){
	.container{
		grid-template-columns: 1fr;
	}
	.img{
		display: none;
	}
	.wave{
		display: none;
	}
	.login-content{
		justify-content: center;
	}
}
     </style>
    <title>Login SARB</title>
</head>
<body class="formas">
    <img class="wave" src="{{asset('assets/img/wave.png')}}">
	<div class="container">
		<div class="img">
			<img src="{{asset('assets/img/bg.svg')}}">
		</div>
		<div class="login-content">
			<form method="POST" action="{{ route('login_post') }}" name="flogin" id="flogin" autocomplete="off" class="form-table form-login" > 
                @csrf
				<img src="{{asset('assets/img/avatar.svg')}}" id="cancelarBtn">
				<h2 class="title">Inicio Sesion</h2>
           		<div class="input-div one">
           		   <div class="i">
                        <i class="bi bi-person-circle" style="font-size: 2rem; color: rgb(50, 58, 58);" ></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input class="input" id="email" type="number" name="email" >
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
                      <i class="bi-key" style="font-size: 2rem; color: rgb(50, 58, 58);"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="text" class="input" id="password" name="password" >
            	   </div>
            	</div>

            	<input type="submit" class="btn" value="Conectarse">
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
            </form>
        </div>
    </div>

    <script src="{{ asset("bootstrap4/jquery/jquery-3.3.1.min.js")}}" type="text/javascript"></script>
	<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
    <script>
        const inputs = document.querySelectorAll(".input");
        function addcl(){
            let parent = this.parentNode.parentNode;
            parent.classList.add("focus");
        }
        function remcl(){
            let parent = this.parentNode.parentNode;
            if(this.value == ""){
                parent.classList.remove("focus");
            }
        }
        inputs.forEach(input => {
            input.addEventListener("focus", addcl);
            input.addEventListener("blur", remcl);
        });
    </script>
	<script type="text/javascript" src="{{ asset('assets/scripts/admin/login.js') }}"></script>
</body>
</html>

{{--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Seccion estilos -->
     <link rel="stylesheet" href="{{ asset("assets/styles/stylelogin.css")}}"> <!-- href="{ asset('styles/stylelogin.css') }}">-->
     <link href="{{ asset("bootstrap4/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" /> <!-- "{ asset('css/bootstrap.min.css') }}"> ------>
    <!-- Fin Seccion estilos jumbotron -->
    <title>Document</title>
</head>
<body class="formas">
    
    <div class="container " >
            <div class="boxlogin">
                <form method="POST" action="{{ route('login_post') }}"  name="flogin" id="flogin" class="border p-3 form" autocomplete="off" >
                   @csrf
                    <div class="img-responsive ">
                        <img class="imagelogin" src="{{ asset('assets/img/hdb2.jpg') }}" >
                    </div>
                    <h3 class="text-center fw-bold title_name">Iniciar Sesion</h3>
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
--}}
