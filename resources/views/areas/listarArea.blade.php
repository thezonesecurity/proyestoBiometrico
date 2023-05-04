@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col-md "> 
    @include('dashboard.mensaje')
    <div class="box-body">
        <h3 class="box-title text-center">Lista de Areas de los Servicios H.D.B.</h3>
        <table id="example" class="table table-sm table-bordered table-striped"  width="60%">
            <thead>
                <tr>
                    <th>Nro.</th>
                    <th>Area</th>
                    <th>Servicio</th>
                    <th>Estado</th>
                    <th>Opciones
                      <!-- boton registrar servicio-->
                      <button data-toggle="modal" href="#registrar_areaModal" class="btn btn-sm btn-primary" style="margin-left: 60px">Registar Nueva Area</button>
                      @include('areas.registrarArea')  
                    </th>
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
                            <button type="button" class="btn btn-success btn-sm edit" value="{{$area->id}}" data-toggle="modal" data-target="#Actualizar_Area">Editar</button>
                            <a href="{{ route('inhabilitar.area.servicio', $area->id)}}" type="buton" class="btn btn-sm btn-danger" style="margin-left: 20px">Inhabilitar</a>
                            @else
                            <button type="button" class="btn btn-secondary btn-sm edit" value="{{$area->id}}" data-toggle="modal" data-target="#Actualizar_Area" disabled>Editar</button>
                            <a href="{{ route('habilitar.area.servicio', $area->id)}}" type="buton" class="btn btn-sm btn-warning" style="margin-left: 20px">Habilitar</a>
                            @endif 
                           {{-- <a href="{{ route('eliminado.servicio', $servicio->id)}}" type="buton" class="btn btn-info">Eliminar</a>--}}
                        </td>
                    </tr>
                    @endforeach
                    @include('areas.editarArea')
                @endif
            </tbody>
        </table>
    </div>
</div>
    
@stop

@section('titulo')
 - Areas
@stop

@section('styles')
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('scripts/admin/areas.js') }}"></script>
@stop



