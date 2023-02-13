@extends("theme/LTE/layout") <!--extends se situa en views-->
@section('cuerpo')
<br>
<div class="table-responsive d-flex justify-content-center col-md-10" style="margin-left: auto" ><!--style="margin-left: 250px"-->
    <div class="col-md-12"> 
        @if (session('creado'))
        @include('servicios.mensaje')
        @endif
        <div class="col-md-6">
            <!-- search form -->
            <div class="">
                <form id="searchServicio" action="" method="" class="sidebar-form" >
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..."/>
                        <span class="input-group-btn">
                            <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- /.search form -->  
        </div>
        <div class="col-md-6">
            <button data-toggle="modal" href="#registrar_servicioModal" class="btn btn-primary" style="margin-left: 60px">Registar Nuevo Servicio</button>
        </div>
    </div>
    
    <!--tabla de lista de servicios-->
    <div class="container-fluid" style="padding-top: 40px">
        <h3 class="box-title text-center">Lista de Servicio H.D.B.</h3>
    </div>
   
    <div class="box-body">
        <table id="example" class="table table-bordered table-striped"  width="60%">
            <thead>
                <tr>
                    <th>Nro.</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Opciones</th>
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
                            <a data-toggle="modal" href="#" class=" btn btn-success col-md-3" disabled type="buton" style="margin-left: 20px">Editar</a>
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



