<!--Modal crear servicio-->
<div class="modal fade" id="registrar_servicioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Servicio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'guardar.servicio', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                <div class="form-group">
                    {!! Form::label('Nombre', 'Nombre Del Nuevo Servicio') !!}
                    {!! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required', 'placeholder'=>"Ingrese nombre del servicio, solo letras min. 5 caracteres",
                     'pattern'=>"[A-Za-z ]{5,60}",'onkeyup'=>"mostrarvalo(this.value)"]) !!}
                </div>
                <div class="form-group">
                    <div class="modal-footer"> 
                        {!! Form::submit('Guardar', ['class' => 'btn btn-primary' ] ) !!} 
                        {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal", 'id'=>"limpiarmodal" ] ) !!}
                    </div>
                </div>
            {!! Form::close() !!}
      </div>
    </div>
  </div>

@section('scripts')

@stop


<!--
<div class="container">
    <br>
    <!-- si se necesita cambiar tamaño de modal agregar modal-lg a la linea 
    <div class="modal-dialog"> por <div class="modal-dialog modal-lg">-->
    
    <!-- Modal--
    <div class="modal fade" id="registrar_servicioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Registar Nuevo Servicio</h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding:15px">
                        <div class="panel-body" id="myModal">
                            !! Form::open(['route' => 'guardar.servicio', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                              <div class="form-group">
                                  !! Form::label('Nombre', 'Nombre Del Nuevo Servicio') !!}
                                  !! Form::text('nombre', null, ['class' => 'form-control' , 'required' => 'required', 
                                  'placeholder'=>"Ingrese nombre del servicio, solo letras min. 5 caracteres", 'pattern'=>"[A-Za-z ]{5,60}",
                                  'onkeyup'=>"mostrarvalo(this.value)"]) !!}
                              </div>
                              <!--
                              ?php 
                                    $existeservicio = DB::table('reportesbiometrico.servicios')->select('nombre')->get();
                                   foreach ($existeservicio as $servicio) {
                                    //print $servicio->nombre;
                                        if($servicio->nombre == 'Nutricione'){
                                            print 'servicio ya registrado';
                                         break;
                                        }
                                        else{
                                           // print "seguir";
                                          // print $servicio->nombre;
                                        }    
                                   }    
                                ?>
                               
                                <div class="texto">
                                    <label for="">ingreso</label>
                                    <input type="text" value=""  class="form-control" onkeyup="mostrarvalor(this.value)"><br>
                                </div>
                                <hr>
                                <h5>resultado -> </h5>
                                <div class="" id="resultadoinput"></div>
                                <script>
                                    //valor = ucwords(valor);
                                    function mostrarvalor(valor){
                                       // document.getElementById("resultadoinput").innerHTML = valor;
                                        var nom =  document.getElementById("resultadoinput").innerHTML = valor;
                                        return nom;
                                    }
                                   console.log(nom);
                                </script>

                           
                              <div class="alert alert-danger" role="alert">
                                <h5 class="alert-heading">Lo sentimos ubo un problema con la creacion del nuevo servicios!</h5>
                                <p> {$servicio->nombre}}</p>  
                              </div> --
                              <div class="form-group">
                                  !! Form::submit('Guardar', ['class' => 'btn btn-success col-md-3 ' ] ) !!}
                                  !! Form::submit('Cancelar', ['class' => 'btn btn-danger col-md-3', 'style' => "margin-left: 120px", 'data-dismiss'=>"modal", 'id'=>"limpiarmodal" ] ) !!}
                              </div>
                            !! Form::close() !!}
                          </div>            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->