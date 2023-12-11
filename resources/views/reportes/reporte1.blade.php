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

<div class="containers" >
        <div class="row">
          <div class="col-md-3">
            <form action="{{route('primer.reporte.rolturno')}}" method="post" class="border border-info col-md-10 mt-4" id="form_reportOne" autocomplete="off">
              <h5 class="box-title text-center font-weight-bold">Formulario reportes</h5>
              @csrf
              <div class="form-group">
                <input class="form-check-input ml-1" type="radio" name="opcion" id="optionTodos" value="Todos" checked>
                <label class="form-check-label ml-4" for="exampleRadios1">Todos </label>
                <input class="form-check-input ml-4" type="radio" name="opcion" id="optionIndividual" value="PorPersona">
                <label class="form-check-label ml-5" for="exampleRadios1">Por persona </label>
              </div>

              <div class="form-group" id="controlItem">
                <label for="select1" class="font-weight-bold">Tipo item</label>
                <select class="form-control" name="tipo_item" id="tipo_item" >
                  <option value="" selected >Selecione una opcion</option>
                  <option value="all">Todos</option>
                  <option value="item">Items</option>
                  @foreach($items as $id => $item) 
                      <option value="{{$id}}">{{$item}}</option>  
                  @endforeach
                </select>
              </div>

              <div class="form-group " id="controlPersona" style="display: none">
                <label for="select3" class="font-weight-bold">Persona</label>
                <select class="form-control custom-select select2" style="width: 100%;" name="persona" id='persona'>
                  <option value="" disabled selected>Selecione una opcion</option>
                  @foreach($personas as $id => $persona)   
                      <option value="{{$id}}" >{{$persona}}</option>  
                  @endforeach
                </select>
              </div>
  
              <div class="form-group ">
                  <label for="month1" class="font-weight-bold">Fecha Desde</label>
                  <input type="date" class="form-control" name="fecha_inicio" id="fec_ini" value="2023-01-01">
              </div>
              <div class="form-group ">
                  <label for="month2" class="font-weight-bold">Fecha Hasta</label>
                  <input type="date" class="form-control" name="fecha_fin" id="fin_fin" value="2023-01-31">
              </div>
              <div class="form-group mt-4 row">
                  <button type="submit" class="btn btn-sm btn-success ml-3 text-white">Buscar</button>
                  {{--<button type="submit" class="btn btn-sm btn-warning ml-2 text-white">PDF</button>
                  <button type="submit" class="btn btn-sm btn-info ml-2 text-white">Excel</button>--}}
                  <button type="reset"  class="btn btn-sm btn-secondary ml-2 text-white">Cancelar</button> {{--name="accion" value="Aceptado"--}}
              </div>
          </form>
          </div>

          <div class="col-md-9">
            <h5 class="box-title text-center font-weight-bold">Lista de reportes</h5>
            
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>one</td>
                  <td>last</td>
                  <td>habdle</td>
                </tr>
              </tbody>
              </table>
              
          </div>

        </div>

  </div>
  
@stop


@section('scripts')
<script type="text/javascript" src="{{ asset('bootstrap4/js/select2/select2.js') }}"></script>
<script type="text/javascript">
  $('.select2').select2({
      placeholder: "Seleccione una opcion",
      allowClear: true,
      ancho : 'resolver'
  });
</script>

<script src="{{asset('jquery-validate/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/scripts/admin/reportesOne.js') }}"></script>


@stop