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
        <div class="row" style="font-size: 13px;">
          <div class="col-md-3">
            <h5 class="box-title text-center font-weight-bold">Formulario de reportes</h5>
            <form action="{{route('primer.reporte.rolturno')}}" method="post" class="border border-info" id="form_reportOnes" autocomplete="off">
              @csrf
            <div class="m-3">
              <div class="form-group">
                <label for="select1" class="font-weight-bold">Tipo item</label>
                <select class="form-control" name="tipo_item" id="tipo_item">
                  <option value="" selected>Selecione una opcion</option>
                  <option value="all">Todos</option>
                  <option value="item">Items</option>
                  @foreach($items as $id => $item) 
                      <option value="{{$id}}">{{$item}}</option>  
                  @endforeach
              </select>
              </div>

              <div class="form-group ">
                <label for="select3" class="font-weight-bold">Persona</label>
                <select class="form-control custom-select select2" style="width: 100%" name="persona" id='persona'>
                  <option value="" disabled selected>Selecione una opcion</option>
                  <option value="all">Todos</option>
                  @foreach($personas as $id => $persona)   
                      <option value="{{$id}}" >{{$persona}}</option>  
                  @endforeach
              </select>
              </div>
  
              <div class="form-group ">
                  <label for="month1" class="font-weight-bold">Fecha inicio</label>
                  <input type="date" class="form-control" name="fecha_inicio" id="fec_ini">
              </div>
              <div class="form-group ">
                  <label for="month2" class="font-weight-bold">Fecha fin</label>
                  <input type="date" class="form-control" name="fecha_fin" id="fin_fin">
              </div>
              <div class="form-group mt-4 row">
                  <button type="submit" class="btn btn-sm btn-success ml-3 text-white">Buscar</button>
                  {{--<button type="submit" class="btn btn-sm btn-warning ml-2 text-white">PDF</button>
                  <button type="submit" class="btn btn-sm btn-info ml-2 text-white">Excel</button>--}}
                  <button type="reset"  class="btn btn-sm btn-secondary ml-2 text-white">Cancelar</button> {{--name="accion" value="Aceptado"--}}
              </div>
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
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Larry</td>
                  <td>the Bird</td>
                  <td>@twitter</td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>



        {{--<h4 class="box-title text-center font-weight-bold">Formulario de reportes</h4>
        <form action="{{route('primer.reporte.rolturno')}}" method="post" class="border border-info" id="form_reportOne" autocomplete="off">
            @csrf
          <div class="form-row m-3">
            <div class="form-group col-md-2">
              <label for="select1" class="font-weight-bold">Tipo item</label>
              <select class="form-control" name="tipo_contrato" id="t_contrato">
                <option value="" selected>Selecione una opcion</option>
                <option value="all">Todos</option>
                <option value="item">Items</option>
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
            </div>--} }
            <div class="form-group col-md-3">
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
            <div class="form-group col-md-3 mt-4 row">
                <button type="submit" class="btn btn-success ml-3 text-white">Buscar</button>
                <button type="submit" class="btn btn-warning ml-2 text-white">PDF</button>
                <button type="submit" class="btn btn-info ml-2 text-white">Excel</button>
                <button type="reset" id="cancelarBtn"  class="btn btn-secondary ml-2 text-white">Cancelar</button> {{--name="accion" value="Aceptado"--} }
            </div>
          </div>
        </form>--}}
        {{---lista--}}
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