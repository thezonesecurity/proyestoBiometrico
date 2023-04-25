@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col-md "> 
    @if (session('creado'))
    @include('servicios.mensaje')
    @endif
    <div class="box-body">
        <h3 class="box-title text-center">Lista de Cambio de Turnos</h3>
        <table id="example" class="table table-bordered table-striped"  width="60%">
            <thead>
                <tr>
                    <th>Nro.</th>
                    {{--<th>usuario</th>--}}
                    <th>Persona Saliente</th>
                    <th>Persona Reemplazo</th>
                    <th>Servicio</th>
                    <th>fecha</th>
                    <th>Observacion</th>
                    <th>Estado</th>
                    <th>Opciones
                      <!-- boton registrar servicio-->
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalRegistrarCambioTurno">Registrar</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($cambio_turnos->isEmpty() && $cambio_turnos->count() == 0) 
                    <tr>
                        <td colspan="8" class="">No hay ningun servicio registrado aun... </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($cambio_turnos as $cambioturno)
                    <tr>
                        <td>{{ ++$i }}</td>
                        {{--<td>{{ $cambioturno->Usuario }}</td> {{$rolturno->user->per_user->nombres}} {{$rolturno->user->per_user->apellidos}}--}}
                        <td>{{ $cambioturno->per_saliente }}</td>
                        <td>{{ $cambioturno->cambioRoltuno->rolturno_per->nombres }}</td>
                        <td>{{ $cambioturno->cambioturno_servicio->nombre }}</td>
                        <td>{{ $cambioturno->fecha }}</td>
                        <td>{{ $cambioturno->obs }}</td>
                        <td>{{ $cambioturno->estado }}</td>

                        <td style='background-color: ;'>
                            {{--<a data-toggle="modal" href="#ActualizarcambioTurno{{ $$cambioturno->id}}" class=" btn btn-success col-md-3"  type="buton" style="margin-left: 20px">Editar</a>--}}
                            <a href="{{ route('eliminar.cambioturno', $cambioturno->id)}}" type="buton" class="btn btn-danger" style="margin-left: 20px">Eliminar</a>
                        </td>
                    </tr>
                    {{--@include('cambioTurno.ModalEditar')--}}
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
    @include('cambioTurno.ModalRegistrar')  
@stop

@section('titulo')
 - Servicio
@stop

@section('styles')

@stop

@section('scripts')

<script>
    $(document).ready(function(){
        $(document).on('change', '.verificar', function(e) { 
            e.preventDefault();
            if(document.getElementById("servicio").value != '' && document.getElementById("gestion").value != ''){
                
                 //PROCESO PARA SABER SI YA ESTA REGISTRADO EL SERVICIO Y LA GESTION DE ROL TURNO
                $.ajax({
                    url: "{{ route('existe.rolturno.gestion') }}",
                    data: { datos1: document.getElementById("servicio").value, datos2: document.getElementById("gestion").value },
                    success: function(data){
                   // alert(data)
                      if(data == 'no existe'){ //resp=='error'
                            toastr.error("ERROR NO SE TIENE REGISTRADO EL ROL TURNO DE ESA GESTION",{"positionClass": "toast-bottom-right"});	
                            setTimeout(function(){	
                                window.location="{{ route('listar.cambio_turno') }}";
                            },4000);
                        return false;
                        }
                        if(data == 'no aceptado'){ //resp=='error'
                            toastr.warning("ADVERTENCIA EL ROL TURNO DE ESA GESTION NO HA SIDO ACEPTADO",{"positionClass": "toast-bottom-right"});	
                            setTimeout(function(){	
                                window.location="{{ route('listar.cambio_turno') }}";
                            },4000);
                        return false;
                        }
                    }
                });
                 //PROCESO PARA SABER K PERSONAS PERTENECE A K SERVICIO
                 const personas1 = $('#per1');
                 const personas2 = $('#per2');
                if($('#servicio :selected').text() != 'Seleccione un servicio'){
                   // var id_servi=document.getElementById("servicio").value; // $('#servicio :selected').text();
                    //console.log("entro ->"+ area);
                    $.ajax({
                        url: "{{ route('servicio.personas.cambioturno') }}",
                        data: { servicio: document.getElementById("servicio").value }, //$(this).val() 
                        success: function(data){
                            personas1.html('<option value="" selected disabled > Selecione una opcion </option>');
                            personas2.html('<option value="" selected disabled > Selecione una opcion </option>');
                            $.each(data, function(id, value) {
                                personas1.append('<option value="' + id + '">' + value + '</option>');
                                personas2.append('<option value="' + id + '">' + value + '</option>');
                            });
                        }
                    });
                }
            }
        });

        $(document).on('change', '.control', function(e) { 
            e.preventDefault();
             //PROCESO PARA SABER SI LA PERSONA TIENE UN ROL DE TURNO EN ESA FECHA
            if($('#per1 :selected').text() != 'Selecione una opcion' && document.getElementById("fecha").value != ''){
                $.ajax({
                    url: "{{ route('control.persona.rolturno') }}",
                    data: { per1: document.getElementById("per1").value, fecha: $('#fecha').val() }, //$(this).val() 
                    success: function(data){
                      //  alert(data);
                        if(data == 'no existe'){ //resp=='error'
                            toastr.error("ERROR LA PERSONA NO TIENE UN ROL DE TURNO EN ESA FECHA ",{"positionClass": "toast-bottom-right"});	
                            /*setTimeout(function(){	
                                window.location="{{ route('listar.cambio_turno') }}";
                            },4000);*/
                        return false;
                        }
                    }
                });
            }
        });
        
    });
</script>
@stop

