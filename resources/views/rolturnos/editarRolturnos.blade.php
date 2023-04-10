@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')    

    <div class="" id="estes"> {{--listar tabla--}}
        <center class="font-weight-bold mt-2">Lista de Roles de Turno</center> <br>
        <table id="mytable" class="table table-sm table-striped border" style="font-size: 12px;  table-layout: fixed;" width="">
            <tr class="titulo" >
                <th width="4%">Nro.</th>
                <th style="" width="150px">Persona</th>
                <th style="" width="99px">Servicio</th>
                <th style="" width="120">Area</th>
                <th style="" width="60px">tipo dia</th>
                <th style="" width="80px">Fecha ini</th>
                <th style="" width="80px">Fecha fin</th>
                <th style="" width="80px">Hora ini</th>
                <th style="" width="80px">Hora fin</th>
                <th style="" width="90">turno</th>
                {{--<th style="" width="180px">estado</th>--}}
                <th style="" width="180px">Observacion</th>
                <th style="" width="80px">Accion</th>
            </tr>
                                 
            <tbody> <?php  $i=0; ?>
                @foreach ($per_rolturnos as $rolturno)
                   @if($rolturno->estado == 'Habilitado')             
                        <tr>
                            <td>{{++$i}}</td>
                            <td><span id="persona{{$rolturno->id}}" >{{$rolturno->rolturno_per->nombres}}</span></td>
                            <td><span id="servicio{{$rolturno->id}}" >{{$rolturno->per_rolturno->servicios->nombre}}</span></td>
                            @php $areas=\App\Models\areaservicio\AreaServicio::where('id',$rolturno->area_id)->first(); @endphp
                            <td><span id="area{{$rolturno->id}}" >{{$rolturno->area->nombre}}</span></td>
                            <td><span id="tdia{{$rolturno->id}}" >{{$rolturno->tipo_dia}}</span></td>
                            <td><span id="f_ini{{$rolturno->id}}" >{{$rolturno->fecha_inicio}}</span></td>
                            <td><span id="f_fin{{$rolturno->id}}" >{{$rolturno->fecha_fin}}</span></td>
                            <td><span id="h_ini{{$rolturno->id}}" >{{$rolturno->hora_inicio}}</span></td>
                            <td><span id="h_fin{{$rolturno->id}}" >{{$rolturno->hora_fin}}</span></td>
                            <td><span id="turno{{$rolturno->id}}" >{{$rolturno->turno}}</span></td>
                            {{--<td><span id="estado{{$rolturno->id}}" >{{$rolturno->estado}}</span></td>--}}
                            <td><span id="obs{{$rolturno->id}}" >{{$rolturno->obs}}</span></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm editbtn" value="{{$rolturno->id}}" data-toggle="modal" data-target="#editModal"><i class="bi bi-pencil-square" style="font-size: 14px;"></i></button>
                                <a type="button" class="btn btn-danger btn-sm debaja" href="{{route('rolturno.eliminado', $rolturno->id)}}"><i class="bi bi-trash" style="font-size: 14px;"></i> </a>
                            </td>
                        </tr>
                        @include('rolturnos.ModalEditarRolturno')
                    @endif
                @endforeach
            </tbody>
        </table> 
    </div>


   
@stop

@section('titulo')
 - Esditar Rolturno
@stop

@section('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap4/css/select2/select2.css') }}">
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('bootstrap4/js/select2/select2.js') }}"></script>
<script type="text/javascript">
    $('.select2').select2({
        placeholder: "Seleccione una opcion",
        allowClear: true
    });
</script>

<script type="text/javascript" src="{{ asset('scripts/editarturno.js') }}"></script>

@stop
