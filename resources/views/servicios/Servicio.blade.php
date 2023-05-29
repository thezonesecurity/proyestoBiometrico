@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Servicio
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
<style>
  .error {
  color: red;
}
</style>
@stop

@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col-md "> 
 
    <div class="box-body">
        <h4 class="box-title text-center">Registrar nuevo servicio</h4>
        <form action="{{route('registrar.servicio')}}" method="post" class="border border-info" id="formRegistrarServicio" autocomplete="off">
            @csrf
            <div class="form-row mt-2">
                <div class="form-group col-md-4 ml-4">
                  <label class="font-weight-bold">Nombre del Servicio</label>
                  <input type="text" class="form-control" name="servicioR" id="servicioR" placeholder="Ingreso un nombre de servicio">
                </div>
                <div class="form-group col-md-4 ml-4">
                  <label class="font-weight-bold">Responsable del servicio</label>
                  <select class="form-control custom-select text-uppercase select2" name="personaR" id="personaR">
                    <option value="0" disabled selected>Selecione una opcion</option>
                    @foreach($users as $user)   
                        @if($user->estado == 'enable')
                            <option value="{{$user->id}}" > {{$user->per_user->nombres}} {{$user->per_user->apellidos}}</option> 
                        @endif  
                    @endforeach
                </select>
                </div>
                <div class="form-group col-md-3 ml-4">
                  <label class="font-weight-bold">Acciones</label> <br>
                  <button type="submit" id="registrar" class="btn btn-outline-success">Registrar</button>
                  <button type="reset" id="cancelarBtn" class="btn btn-outline-secondary ml-2">Limpiar</button>
                </div>
              </div>
        </form>

        @include('dashboard.mensaje')
          
        <h4 class="box-title text-center mt-2">Lista de Servicio H.D.B.</h4>
        <table id="listaServicios" class="table table-sm table-bordered table-striped"  width="100%"> {{--listaServicios--}}
            <thead>
                <tr>
                    <th width="20px">Nro.</th>
                    <th width="180px">Nombre</th>
                    <th width="200px">Responsable</th>
                    <th width="100px">Estado</th>
                    <th width="150px">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @if($servicios->isEmpty() && $servicios->count() == 0) 
                    <tr>
                        <td colspan="5" class="">No hay ningun servicio registrado aun... </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td id="servicio{{$servicio->id}}">{{ $servicio->nombre }}</td>{{--servicio{{$servicio->id}}--}}
                        <td id="responsable{{$servicio->id}}">{{$servicio->user->per_user->nombres}} {{$servicio->user->per_user->apellidos}}</td>
                        <td id="estado{{$servicio->id}}">{{ $servicio->estado }}</td>
                        <td style='background-color: ;'>
                            @if($servicio->estado == "Habilitado")
                            <button type="button" class="btn btn-outline-success btn-sm edit" value="{{$servicio->id}}" data-toggle="modal" data-target="#ActualizarServicio">Editar</button>               
                            <a href="{{ route('inhabilitar.servicio', $servicio->id)}}" type="buton" class="btn btn-sm btn-outline-danger " style="margin-left: 20px">Inhabilitar</a>
                            @else
                            <button type="button" class="btn btn-outline-secondary btn-sm " value="{{$servicio->id}}" data-toggle="modal" data-target="#ActualizarServicio" disabled>Editar</i></button>                
                            <a href="{{ route('habilitar.servicio', $servicio->id)}}" type="buton" class="btn btn-sm btn-outline-warning " style="margin-left: 20px"><span class="font-weight-bold">Habilitar</span></a>
                            @endif 
                           {{-- <a href="{{ route('eliminado.servicio', $servicio->id)}}" type="buton" class="btn btn-info">Eliminar</a>--}}
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @include('servicios.ModalEditar')
    </div>
</div>
    
@stop

@section('scripts')
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/servicios.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#listaServicios').DataTable({
            "lengthMenu": [[ 10 , 30, 60, -1], [ 10 , 30, 60, "All"]],
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



@stop

