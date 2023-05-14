
@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')
    

<div class="form-group">
    <label for="inputName">Nombre:</label>
    <input type="text" class="form-control" id="inputName">
    <small id="validacionNombre" class="form-text"></small>
</div>
<div class="form-group">
    <label for="inputName">Fecha:</label>
    <input type="date" class="form-control" id="inputfecha">
    <small id="validacionFecha" class="form-text text-danger"></small>
</div>

    <div class="row justify-content-center align-content-center">
       <h4> <span >Lista de roles de turnos</span> </h4>
       <a type="button" class="btn btn-warning btn-sm " href="{{route('tablas')}}" >tabla</a>
    </div>
    {{--<table class="table table-striped" id="myTable"> </table>--}}
    <table id="listarturnos" class="table table-sm table-bordered table-striped"  width="100%"> 
        <thead>
            <tr class="titulo" > {{--style="background-color: red;display: none;"--}}
                <th width="5px">Nro.</th>
                <th style="" width="60px">Usuario</th>
                <th style="" width="60px">Servicio</th>
                <th style="" width="20px">Estado</th>
                <th style="" width="20px">Gestion</th>
                <th style="" width="100">Observacion</th>
                <th style="" width="40">Accion</th>
            </tr>
        </thead>
        <tbody> <?php  $i=0; ?>
            @if($rolturnos->isEmpty() && $rolturnos->count() == 0) 
                <tr>
                    <td colspan="7" class="">No hay registros que mostrar </td>
                </tr>
            @else 
                 @foreach ($rolturnos as $rolturno)
                    <tr>
                        <td>{{++$i}}</td>
                        <td><span id="" >{{$rolturno->user->per_user->nombres}} {{$rolturno->user->per_user->apellidos}}</span></td>
                        <td><span id="servicio{{$rolturno->id}}" >{{$rolturno->servicios->nombre}}</span></td>
                        {{--<td><span id="" >{{$rolturno->estado}}</span></td>--}}
                        <td><span id="" >{{$rolturno->estado}}</span></td>
                        <td><span id="" >{{$rolturno->gestion}}</span></td>
                        <td><span id="" >{{$rolturno->obsevacion}}</span></td>
                        <td>
                            @if($rolturno->estado == 'Temporal' || $rolturno->estado == 'Rechazado')
                            {{--<a type="button" class="btn btn-primary btn-sm editbtn" href="{{route('editar.rolturno', $rolturno->id)}}" >Editar</a>--}}
                            <a type="button" class="btn btn-info btn-sm" href="{{route('editar.rolturno.test', $rolturno->id)}}" id="registro">Seguir registrando</a>
                            <a type="button" class="btn btn-warning btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank' >Reporte PDF</a>
                            <a data-toggle="modal" href="#rolturnEnviar{{ $rolturno->id }}" class=" btn btn-success btn-sm"  type="buton">enviar</a>

                            @else
                            {{--<button type="button" class="btn btn-secondary btn-sm editbtn" href="{{route('editar.rolturno', $rolturno->id)}}" disabled>Editar</button>--}}
                            <button type="button" class="btn btn-secondary btn-sm" href="{{route('editar.rolturno.test', $rolturno->id)}}" id="registro" disabled>Seguir registrando</button>
                            <a type="button" class="btn btn-warning btn-sm " href="{{route('rolturno.imprimir.pdf', $rolturno->id)}}" target='_Blank' >Reporte PDF</a>
                            <button data-toggle="modal" href="#rolturnEnviar{{ $rolturno->id }}" class=" btn btn-secondary btn-sm"  type="buton" disabled>enviar</button>
                            @endif
                        </td>
                    </tr>
                    @include('rolturnos.EnviarRolturno')
                 @endforeach
            @endif
        </tbody>
    </table>

@stop

@section('titulo')
 - ListarRolturnos
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
@stop

@section('scripts')
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#listarturnos').DataTable({
            "lengthMenu": [[5, 15 , 30, 60, -1], [5, 15 , 30, 60, "All"]],
            language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
        });
    });
</script>
<script>
 /*  function verificarInput(valor, elementoValidacion, rules, idInput, msmValidado) {
    if (valor !== '') {
      if(rules.test(valor)){
        elementoValidacion.addClass('text-success');
        elementoValidacion.removeClass('text-danger');
        elementoValidacion.text('Campo Validado y verificado').show();
        idInput.removeClass('is-invalid');
      }else{
        elementoValidacion.addClass('text-danger');
        elementoValidacion.removeClass('text-success');
        elementoValidacion.text(msmValidado).show();
        idInput.addClass('is-invalid');
      }
    } else {
      elementoValidacion.addClass('text-danger');
      elementoValidacion.removeClass('text-success');
      elementoValidacion.text('Por favor ingrese este campo').show();
      idInput.addClass('is-invalid');
    }
  }*/

    $(document).ready(function() {
        $('#inputName').on('input', function() { // VALIDAACION PARA INPUT TEXT
            //var nameValue = $(this).val();
            var letras = /^[a-zA-Z ]{5,10}$/;
            //function verificarInput(valor, elementoValidacion, rules, idInput, msmValidado)
            if($(this).val() !== ''){//campo valido
                verificarInput($(this).val(), $('#validacionNombre'), letras, $('#inputName'), 'Formato Invalido, se permite mayusculas, minusculas, min 5 y max 10');
            }else{//campo no valido
                verificarInput($(this).val(), $('#validacionNombre'), letras, $('#inputName'));
            }
        });
    

        $('#inputfecha').on('input', function() { // VALIDAACION PARA INPUT DATE
            var nameValue = $(this).val();
            //$('#nameValue').text('El valor del input es: ' + nameValue);
            //console.log('sata - '+  nameValue);
           if(nameValue != ''){
                console.log('sata - '+  nameValue);
                $("#inputfecha").removeClass('is-invalid');
                $('#validacionFecha').text('Por favor ingrese una fecha').hide();
               
            }else {
                console.log('sata ->  vacio');
                $("#inputfecha").addClass('is-invalid');
                $('#validacionFecha').text('Por favor ingrese una fecha').show();
            }  
        });

            /*
            -----------------------------------------------------------
                         function verificarInput(valor, elementoValidacion) { FUNCIONA 1
                if (valor !== '') {
                elementoValidacion.removeClass('text-danger');
                elementoValidacion.addClass('text-success');
                elementoValidacion.text('Campo Valido').show();
                } else {
                elementoValidacion.addClass('text-danger');
                elementoValidacion.removeClass('text-success');
                elementoValidacion.text('Por favor ingrese este campo').show();
                }
            }
             FUNCIONAL 1
            
            if(nameValue !== ''){//campo valido
                verificarInput($(this).val(), $('#validacionNombre'));
                $("#inputName").removeClass('is-invalid');
            }else{//campo no valido
                verificarInput($(this).val(), $('#validacionNombre'));
                $("#inputName").addClass('is-invalid');
            }
            ------------------------------------------------------------
           */
    });

</script>
@stop

