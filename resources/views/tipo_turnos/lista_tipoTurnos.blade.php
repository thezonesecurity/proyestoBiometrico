@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col-md "> 
    @include('dashboard.mensaje')
    <div class="box-body">
        <h3 class="box-title text-center">Lista de Tipos de Turnos</h3>
        <table id="example" class="table table-sm table-bordered table-striped"  width="60%">
            <thead>
                <tr>
                    <th>Nro.</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Opciones
                      <!-- boton registrar servicio-->
                      <button data-toggle="modal" href="#registrar_tipoTurnoModal" class="btn btn-sm btn-primary" style="margin-left: 60px">Registar tipo Turno</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($tipo_turnos->isEmpty() && $tipo_turnos->count() == 0) 
                    <tr>
                        <td colspan="4" class="">No hay ningun servicio registrado aun... </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($tipo_turnos as $tipo_turno)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td id="nombre{{$tipo_turno->id}}">{{ $tipo_turno->nombre }}</td>
                        <td id="estado{{$tipo_turno->id}}">{{ $tipo_turno->estado }}</td>
                        <td style='background-color: ;'>
                            @if($tipo_turno->estado == "Habilitado")
                            <button type="button" class="btn btn-success btn-sm edit" value="{{$tipo_turno->id}}" data-toggle="modal" data-target="#ActualizarTipoTurno">Editar</button>                
                            <a href="{{ route('inhabilitar.tipo.turno', $tipo_turno->id)}}" type="buton" class="btn btn-sm btn-danger " style="margin-left: 20px">Inhabilitar</a>
                            @else
                            <button type="button" class="btn btn-secondary btn-sm " value="{{$tipo_turno->id}}" data-toggle="modal" data-target="#ActualizarTipoTurno" disabled>Editar</i></button>                
                            <a href="{{ route('habilitar.tipo.turno', $tipo_turno->id)}}" type="buton" class="btn btn-sm btn-warning " style="margin-left: 20px">Habilitar</a>
                            @endif 
                        </td>
                    </tr>
                    @include('tipo_turnos.editar_tipoTurno')
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
    @include('tipo_turnos.registrar_tipoTurno') 
@stop

@section('titulo')
 - Tipo de contratos
@stop

@section('styles')
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('scripts/admin/turnos.js') }}"></script>
@stop

