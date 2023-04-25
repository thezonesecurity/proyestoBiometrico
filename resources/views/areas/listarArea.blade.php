@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col-md "> 
    @if (session('creado'))
    @include('servicios.mensaje')
    @endif
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
                    @foreach ($areas as $areaservi)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $areaservi->nombre }}</td>
                        <td id="id_servicio<?php $areaservi->servicio->nombre  ?>">{{ $areaservi->servicio->nombre }}</td>
                        <td>{{ $areaservi->estado }}</td>
                        <td style='background-color: ;'>
                            @if($areaservi->estado == "Habilitado")
                            <a data-toggle="modal" href="#Actualizar_Area" class="btn btn-sm btn-success editBtn"  type="buton" style="margin-left: 20px">Editar</a>
                            <a href="{{ route('inhabilitar.area.servicio', $areaservi->id)}}" type="buton" class="btn btn-sm btn-danger" style="margin-left: 20px">Inhabilitar</a>
                            @else
                            <a data-toggle="modal"  class=" btn btn-sm btn-secondary" disabled="true" type="buton" style="margin-left: 20px">Editar</a>
                            <a href="{{ route('habilitar.area.servicio', $areaservi->id)}}" type="buton" class="btn btn-sm btn-warning" style="margin-left: 20px">Habilitar</a>
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
    @include('areas.registrarArea')  
@stop

@section('titulo')
 - Servicio
@stop

@section('styles')
@stop

@section('scripts')
{{ Html::script( asset('scripts/enviardatosareas.js') )}}
@stop



