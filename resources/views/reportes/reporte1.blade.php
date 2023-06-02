@extends("dashboard/dashboard") <!--extends se situa en views-->
@section('titulo')
 - Reportes
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap4/css/select2/select2.css') }}">
<style>
  .error {
  color: red;}
</style>
@stop

@section('contenido')

<div class="containers">
    <div class="row">
      <div class="col">
        <h4 class="box-title text-center font-weight-bold">Formulario de reportes</h4>
        <form action="{{route('primer.reporte.rolturno')}}" method="post" class="border border-info" id="form_reportOne" autocomplete="off">
            @csrf
          <div class="form-row m-2">
            <div class="form-group col-md-2">
              <label for="select1" class="font-weight-bold">Tipo item</label>
              <select class="form-control" name="tipo_contrato" id="t_contrato">
                <option value="" selected>Selecione una opcion</option>
                <option value="all">Todos</option>
                @foreach($items as $id => $item) 
                    <option value="{{$id}}" >{{$item}}</option>  
                @endforeach
            </select>
            </div>
            {{--<div class="form-group col-md-2">
              <label for="select2" class="font-weight-bold">Personas</label>
              <select class="form-control" name="persona" id="persona">
                <option value="vacio" disabled selected>Selecione una opcion</option>
                <option value="1">Todos</option>
                <option value="2">Con contratos</option>
                <option value="3">Con Items</option>
              </select>
            </div>--}}
            <div class="form-group col-md-2">
              <label for="select3" class="font-weight-bold">Persona</label>
              <select class="form-control custom-select text-uppercase select2" name="persona" id='persona'>
                <option value="vacio" disabled selected>Selecione una opcion</option>
                <option value="all">Todos</option>
                @foreach($personas as $id => $persona)   
                    <option value="{{$id}}" >{{$persona}}</option>  
                @endforeach
            </select>
            </div>

            <div class="form-group col-md-2">
                <label for="month1" class="font-weight-bold">Fecha inicio</label>
                <input type="date" class="form-control" name="fecha_inicio" id="fec_ini">
            </div>
            <div class="form-group col-md-2">
                <label for="month2" class="font-weight-bold">Fecha fin</label>
                <input type="date" class="form-control" name="fecha_fin" id="fin_fin">
            </div>
            <div class="form-group col-md-4 row justify-content-center align-content-center mt-4">
                <button type="submit" class="btn btn-success text-white">Buscar</button>
                <button type="submit" class="btn btn-warning ml-3 text-white">PDF</button>
                <button type="submit" class="btn btn-info ml-3 text-white">Excel</button>
                <button type="reset" id="cancelarBtn"  class="btn btn-secondary ml-3 text-white">Cancelar</button> {{--name="accion" value="Aceptado"--}}
            </div>
          </div>
        </form>
        {{---lista--}}
      </div>
    </div>
  </div>
  
@stop


@section('scripts')
<script type="text/javascript" src="{{ asset('bootstrap4/js/select2/select2.js') }}"></script>
<script type="text/javascript">
  $('.select2').select2({
      placeholder: "Seleccione una opcion",
      allowClear: true
  });
</script>

<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/reportesOne.js') }}"></script>


@stop