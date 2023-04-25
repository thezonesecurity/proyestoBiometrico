@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('contenido')

<div class="table-responsive d-flex justify-content-center " style="margin-left: auto" ><!--style="margin-left: 250px"-->
  <div class="col-md "> 
    @if (session('creado'))
    @include('servicios.mensaje')
    @endif
    <div class="box-body">
        <h3 class="box-title text-center">Lista de Tipos de Contratos</h3>
        <table id="example" class="table table-sm table-bordered table-striped"  width="60%">
            <thead>
                <tr>
                    <th>Nro.</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Opciones
                      <!-- boton registrar servicio-->
                      <button data-toggle="modal" href="#registrar_tipoContratoModal" class="btn btn-sm btn-primary" style="margin-left: 60px">Registar tipo contrato</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($tipo_contratos->isEmpty() && $tipo_contratos->count() == 0) 
                    <tr>
                        <td colspan="4" class="">No hay ningun servicio registrado aun... </td>
                    </tr>
                @else 
                    <?php $i=0; ;?>
                    @foreach ($tipo_contratos as $tipo_contrato)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td id="nombre{{$tipo_contrato->id}}">{{ $tipo_contrato->nombre }}</td>
                        <td id="estado{{$tipo_contrato->id}}">{{ $tipo_contrato->estado }}</td>
                        <td style='background-color: ;'>
                            @if($tipo_contrato->estado == "Habilitado")
                            <button type="button" class="btn btn-success btn-sm edit" value="{{$tipo_contrato->id}}" data-toggle="modal" data-target="#ActualizarTipoContrato">Editar</button>                
                            <a href="{{ route('inhabilitar.tipo.contrato', $tipo_contrato->id)}}" type="buton" class="btn btn-sm btn-danger " style="margin-left: 20px">Inhabilitar</a>
                            @else
                            <button type="button" class="btn btn-secondary btn-sm " value="{{$tipo_contrato->id}}" data-toggle="modal" data-target="#ActualizarTipoContrato" disabled>Editar</i></button>                
                            <a href="{{ route('habilitar.tipo.contrato', $tipo_contrato->id)}}" type="buton" class="btn btn-sm btn-warning " style="margin-left: 20px">Habilitar</a>
                            @endif 
                        </td>
                    </tr>
                    @include('tipo_contratos.editar_tipoContrato')
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
    @include('tipo_contratos.registrar_tipoContrato') 
@stop

@section('titulo')
 - Tipo de contratos
@stop

@section('styles')

@stop

@section('scripts')
<script type="text/javascript">
    //"form-control-sm custom-select text-uppercase select2"
        $('.select2').select2({
            placeholder: "Seleccione una opcion",
            allowClear: true
        });
</script>
<script>
    $(document).on('click', '.edit', function(e){
        e.preventDefault();
		
		var id=$(this).val(); //console.log('id_user',id);
        var nombre =$('#nombre'+id).text();
        var estado =$('#estado'+id).text();     //   console.log('gestion '+gestion);
        console.log('id_user '+ id+' -> '+ nombre);
        
		$('#ActualizarTipoContrato').modal('show');
        $('#idM').val(id);
        $('#t_contratoM').val(nombre);
        $('#estadoM').val(estado);
    });
    
</script>
@stop

