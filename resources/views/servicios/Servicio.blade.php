@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col-md "> 
   @include('dashboard.mensaje')
    <div class="box-body">
        <h3 class="box-title text-center">Lista de Servicio H.D.B.</h3>
        <table id="example" class="table table-sm table-bordered table-striped"  width="60%">
            <thead>
                <tr>
                    <th>Nro.</th>
                    <th>Nombre</th>
                    <th>Responsable</th>
                    <th>Estado</th>
                    <th>Opciones
                      <!-- boton registrar servicio-->
                      <button data-toggle="modal" href="#registrar_servicioModal" class="btn btn-sm btn-primary" style="margin-left: 60px">Registar Nuevo Servicio</button>
                      @include('servicios.crearServicio')  
                    </th>
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
                        <td id="servicio{{$servicio->id}}">{{ $servicio->nombre }}</td>
                        <td id="res"><span id="responsable{{$servicio->id}}">{{$servicio->user->per_user->nombres}} {{$servicio->user->per_user->apellidos}}</span></td>
                        {{--<td id="responsable{{$servicio->id}}">{{$servicio->user->per_user->nombres}} {{$servicio->user->per_user->apellidos}}</td>--}}
                        <td id="estado{{$servicio->id}}">{{ $servicio->estado }}</td>
                        <td style='background-color: ;'>
                            @if($servicio->estado == "Habilitado")
                            <button type="button" class="btn btn-success btn-sm edit" value="{{$servicio->id}}" data-toggle="modal" data-target="#ActualizarServicio">Editar</button>                
                            <a href="{{ route('inhabilitar.servicio', $servicio->id)}}" type="buton" class="btn btn-sm btn-danger " style="margin-left: 20px">Inhabilitar</a>
                            @else
                            <button type="button" class="btn btn-secondary btn-sm " value="{{$servicio->id}}" data-toggle="modal" data-target="#ActualizarServicio" disabled>Editar</i></button>                
                            <a href="{{ route('habilitar.servicio', $servicio->id)}}" type="buton" class="btn btn-sm btn-warning " style="margin-left: 20px">Habilitar</a>
                            @endif 
                           {{-- <a href="{{ route('eliminado.servicio', $servicio->id)}}" type="buton" class="btn btn-info">Eliminar</a>--}}
                        </td>
                    </tr>
                    @include('servicios.ModalEditar')
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
    
@stop

@section('titulo')
 - Servicio
@stop

@section('styles')
{{--
{{ Html::style( asset('DataTables/datatables.min.css') )}}
{{ Html::style( asset('DataTables/DataTables-1.13.2/css/dataTables.bootstrap4.min.css') )}}
--}}
@stop

@section('scripts')
{{--
{{ Html::script( asset('DataTables/dataTables.min.css') )}}
{{ Html::script( asset('bootstrap3/jquery/datatableservicios.js') )}}
--}}
<script type="text/javascript" src="{{ asset('scripts/admin/servicios.js') }}"></script>
@stop



