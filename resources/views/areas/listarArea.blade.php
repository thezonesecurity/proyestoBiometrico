@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Areas
@stop

@section('styles')
{{ Html::style( asset('datatables/dataTables.bootstrap4.min.css') )}}
<style>
    .error {
    color: red;}
</style>
@stop

@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col-md "> 
    <div class="box-body">
        <h4 class="box-title text-center">Registrar nuevo servicio</h4>
        <form action="{{route('guardar.area.servicio')}}" method="post" class="border border-info" id="formRegistrarArea" autocomplete="off">
            @csrf
            @csrf
            <div class="form-row mt-2">
                <div class="form-group col-md-4 ml-4">
                  <label for="recipient-servicio" class="font-weight-bold">Area</label>
                  <input type="text" class="form-control" name="areaR" id="areaR" placeholder="Ingrese un nombre de area">
                </div>
                <div class="form-group col-md-4 ml-4">
                  <label for="recipient-servicio" class="font-weight-bold">Servicio</label>
                    <select class="js-example-basic-single form-control custom-select" name="servicioR" id='servicioR'>
                        <option value="vacio" disabled selected>Selecione una opcion</option>
                        @foreach($servicios as $id => $servicio)   
                            <option value="{{$id}}" >{{$servicio}}</option>  
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

        <h4 class="box-title text-center mt-2">Lista de Areas de los Servicios H.D.B.</h4>
        <table id="listarAreas" class="table table-sm table-bordered table-striped"  width="100%">{{--listarAreas--}}
            <thead>
                <tr>
                    <th width="20px">Nro.</th>
                    <th width="180px">Area del servico</th>
                    <th width="200px">Nombre del servicio</th>
                    <th width="100px">Estado</th>
                    <th width="150px">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @if($areas->isEmpty() && $areas->count() == 0) 
                    <tr>
                        <td colspan="5" class="">No hay ningun registrado para mostrar </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($areas as $area)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td  id="area{{$area->id}}">{{ $area->nombre }}</td>
                        <td  id="servicio{{$area->id}}">{{ $area->servicio->nombre }}</td>
                        <td  id="estado{{$area->id}}">{{ $area->estado }}</td>
                        <td style='background-color: ;'>
                            @if($area->estado == "Habilitado")
                            <button type="button" class="btn btn-outline-success btn-sm edit" value="{{$area->id}}" data-toggle="modal" data-target="#Actualizar_Area">Editar</button>
                            <a href="{{ route('inhabilitar.area.servicio', $area->id)}}" type="buton" class="btn btn-sm btn-outline-danger" style="margin-left: 20px">Inhabilitar</a>
                            @else
                            <button type="button" class="btn btn-outline-secondary btn-sm edit" value="{{$area->id}}" data-toggle="modal" data-target="#Actualizar_Area" disabled>Editar</button>
                            <a href="{{ route('habilitar.area.servicio', $area->id)}}" type="buton" class="btn btn-sm btn-outline-warning" style="margin-left: 20px"><span class="font-weight-bold">Habilitar</span></a>
                            @endif 
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @include('areas.editarArea')
    </div>
</div>

@stop

@section('scripts')
<script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/areas.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#listarAreas').DataTable({
            "lengthMenu": [[15 , 30, 60, -1], [15 , 30, 60, "All"]],
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



