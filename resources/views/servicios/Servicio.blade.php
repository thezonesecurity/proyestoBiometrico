@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col-md-10"> 
    @if (session('creado'))
    @include('servicios.mensaje')
    @endif
    <div class="box-body">
        <h3 class="box-title text-center">Lista de Servicio H.D.B.</h3>
        <table id="example" class="table table-bordered table-striped"  width="60%">
            <thead>
                <tr>
                    <th>Nro.</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Opciones
                      <!-- boton registrar servicio-->
                      <button data-toggle="modal" href="#registrar_servicioModal" class="btn btn-primary" style="margin-left: 60px">Registar Nuevo Servicio</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($servicios->isEmpty() && $servicios->count() == 0) 
                    <tr>
                        <td colspan="4" class="">No hay ningun servicio registrado aun... </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($servicios as $servicio)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $servicio -> nombre }}</td>
                        <td>{{ $servicio -> estado }}</td>
                        <td style='background-color: ;'>
                            @if($servicio->estado == "Habilitado")
                            <a data-toggle="modal" href="#ActualizarServicio{{ $servicio->id }}" class=" btn btn-success col-md-3"  type="buton" style="margin-left: 20px">Editar</a>
                            <a href="{{ route('inhabilitar.servicio', $servicio->id)}}" type="buton" class="btn btn-danger col-md-3" style="margin-left: 20px">Inhabilitar</a>
                            @else
                            <a data-toggle="modal"  class=" btn btn-secondary col-md-3" disabled="true" type="buton" style="margin-left: 20px">Editar</a>
                            <a href="{{ route('habilitar.servicio', $servicio->id)}}" type="buton" class="btn btn-warning col-md-3" style="margin-left: 20px">Habilitar</a>
                            @endif 
                            <a href="{{ route('eliminado.servicio', $servicio->id)}}" type="buton" class="btn btn-info">Eliminar</a>
                        </td>
                    </tr>
                    @include('servicios.ModalEditar')
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
    @include('servicios.crearServicio')  
@stop

@section('titulo')
 - Servicio
@stop

@section('styles')
{{ Html::style( asset('DataTables/datatables.min.css') )}}
{{ Html::style( asset('DataTables/DataTables-1.13.2/css/dataTables.bootstrap4.min.css') )}}
@stop

@section('scripts')
{{ Html::script( asset('DataTables/dataTables.min.css') )}}
{{ Html::script( asset('bootstrap3/jquery/datatableservicios.js') )}}
@stop



