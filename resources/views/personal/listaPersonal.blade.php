@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')
<h3 class="box-title text-center">Lista del personal H.D.B.</h3>
<table id="example" class="table table-bordered table-striped"  width="60%">
    <thead>
      <tr>
        <th scope="col">Nro.</th>
        <th scope="col">Nombre  Completo</th>
        <th scope="col">C.I.</th>
        <th scope="col">Item</th>
        <th scope="col">Servicio</th>
        <th scope="col">Area</th>
        <th scope="col">Estado</th>
        <th scope="col">Opciones
            <!-- boton registrar servicio-->
            <button data-toggle="modal" href="#registrar_servicioModal" class="btn btn-primary" style="margin-left: 60px">Registar Personal</button>
        </th>
      </tr>
    </thead>
    <tbody>
        @if($personas->isEmpty() && $personas->count() == 0) 
            <tr>
                <td colspan="8" class="">No hay ningun personal registrado aun... </td>
            </tr>
        @else 
            <?php $i=0; ;?>
        @foreach ($personas as $persona)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $persona -> nombres.' '.$persona -> apellidos }}</td>
            <td>{{ $persona -> ci }}</td>
            <td>{{ $persona -> item }}</td>
            <td>{{ $persona -> servicio }}</td>
            <td>{{ $persona -> area }}</td>
            <td>{{ $persona -> estado }}</td>
            <td style='background-color: ;'>
                @if($persona->estado == "Habilitado")
                    <a data-toggle="modal" href="#" class="btn btn-success col-md-3"  type="buton" style="margin-left: 20px">Editar</a>
                    <a href="#" type="buton" class="btn btn-danger col-md-3" style="margin-left: 20px">Inhabilitar</a>
                @else
                    <a data-toggle="modal"  class=" btn btn-secondary col-md-3" disabled="true" type="buton" style="margin-left: 20px">Editar</a>
                    <a href="#" type="buton" class="btn btn-warning col-md-3" style="margin-left: 20px">Habilitar</a>
                @endif 
                    <a href="#" type="buton" class="btn btn-info">Eliminar</a>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table

@stop

@section('titulo')
 - Personal
@stop

@section('styles')
@stop

@section('scripts')
@stop

