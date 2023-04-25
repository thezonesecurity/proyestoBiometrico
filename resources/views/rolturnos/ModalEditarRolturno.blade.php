<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Rol turno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! Form::open(['route' => 'editarsave.rolturno', 'method' => 'post', 'autocomplete'=>"off"]) !!}
                <input type="hidden" class="form-control " name="id" id='idM'>
                <div class="form-row font-weight-bold" style="margin-top: -px;">
                    <div class="form-group col-md-6">
                        <label for="hora de inicio">Persona</label>
                        <input type="text" class="form-control custom-select" name="persona" id='personaM' readonly style="font-size: 12px;">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="servicio" style="margin-left: -10px;">Servicio</label>
                        <input type="text" class="form-control custom-select ml-2" name="servicio" id='servicioMo' readonly>
                    </div>
                </div>

                <div class="form-row " style="margin-top: -5px;"> 
                    <div class="form-group col-md-6">
                        <div class="form-check ml-1 col-auto">
                            <input class="form-check-input" type="radio" name="tipod" id="laboralM" value="DL">
                            <label class="form-check-label font-weight-bold" for="gridCheck">Dia laboral</label>
                        </div><br>
                        <div class="form-check col-auto"> 
                            <input class="form-check-input"  style="margin-left: -10px;" type="radio" name="tipod" id="descansoM" value="V">
                            <label class="form-check-label font-weight-bold ml-2" for="gridCheck">Vacacion</label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="font-weight-bold" for="Gestion">Gestion</label>
                        <input type="text" class="form-control" name="gestion" id='gestion' readonly>
                    </div>
                </div>
               
                <div class="form-row font-weight-bold" style="margin-top: -10px;">
                    <div class="form-group col-md-6">
                        {!! Form::label('areaPer', 'Area de la personas', ['class' => 'font-weight-bold' ]) !!}
                        <input type="text" name="area" id='areaM'  class="form-control custom-select" readonly >
                        @php $areas=\App\Models\areas\Area::where('servicio_id','4');  @endphp
                        {{-- <select class="form-control custom-select" name="area" id='areaM' >
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="Gestion">Gestion</option>
                           @foreach($areas as $area)
                            <option value="">{{$areas->nombre}}</option>
                            @endforeach
                        </select>--}}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="turnoo">Turno</label>
                        <select name="turno" id="turnoM" class="form-control custom-select mr-sm-2">
                            <option value="" disabled selected>Elegir turno</option>
                            <option value="Mañana">Mañana</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Dia">Dia</option>
                            <option value="Noche">Noche</option>
                            <option value="12 Hrs.">12 Hrs.</option>
                            <option value="24 Hrs.">24 Hrs.</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row font-weight-bold" style="margin-top: -10px;">
                    <div class="form-group col-md-6">
                        <label for="fecha de inicio">Fecha Inicio</label>
                        <input type="date" class="form-control" name="fecha_inicio" id="f_iniM" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fecha de fin">Fecha Fin</label>
                        <input type="date" class="form-control "  name="fecha_fin" id="f_finM" disabled>
                    </div>
                </div>
                <div class="form-row font-weight-bold" style="margin-top: -10px;">
                    <div class="form-group col-md-6">
                        <label for="hora de inicio">Hora Inicio</label>
                        <input type="time" class="form-control " name="hora_inicio" id="h_iniM">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="hora de fin">Hora Fin</label>
                        <input type="time" class="form-control " name="hora_fin" id="h_finM" >
                    </div>
                </div>

                 <div class="form-row font-weight-bold" style="margin-top: -10px;">
                    <div class="form-group col-md-8">
                        <label class="col font-weight-bold">Observaciones</p>
                            <textarea name="comentario" id="obsM" class="form-control-sm col" placeholder="Este campo es opcional"  style="margin-top: -10px;" ></textarea>
                    </div>
                    <div class="form-group col-md-4" style="margin-top: 30px;">
                        <label class="col" >Cambio turno</label>
                        <input class="form-check-input" type="checkbox" name="cambioT" id="cambio" style="margin-left: -23px;">
                    </div>
                </div>
                {{--<div class="form-group row" style="margin-top: -10px;">
                    <label class="col font-weight-bold">Observaciones</p>
                    <textarea name="comentario" id="obsM" class="form-control-sm col" placeholder="Este campo es opcional"  style="margin-top: -10px;" ></textarea>
                </div>--}}
                        
                <div class="modal-footer" style="margin-top: -30px;">
                    {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-success' ] ) !!} 
                    {!! Form::submit('Cancelar', ['class' => 'btn btn-secondary', 'data-dismiss'=>"modal" ] ) !!}
                </div>
            {!! Form::close() !!}  
          </div>
         
      </div>
    </div>
  </div>

   {{--
                         <table class="table table-sm border border-success"> <!--REGISTRAR ROL TURNO-->
                             <center class="font-weight-bold">Registrar Rol Turno</center>
                             <tr>
                                 <div class="form-group">
                                     {!! Form::label('servicioPer', 'Servicio de la persona', ['class' => 'font-weight-bold text-sm-left' ]) !!}
                                     <select class="form-control-sm custom-select text-uppercase select2" name="servicio" id='servicio'>
                                         <option value="" selected disabled>Seleccione un servicio</option> 
                                         @foreach($servicios as $item)
                                             @if($item->estado == 'Habilitado')
                                                 <option value="{{$item->id}}" > {{$item->nombre}} </option>  
                                             @endif                       
                                         @endforeach
                                     </select>
                                 </div>
 
                                 <div class="form-group " style="margin-top: -10px;">
                                     <label for="personall" class="font-weight-bold">Personal</label>
                                     <select class="form-control-sm custom-select text-uppercase select2" name="personal" id="per" >
                                         <option value="Elegir personal" disabled selected>Elegir una persona</option>
                                         @foreach($personas as $persona)
                                             @if($persona->estado_per == 'Habilitado')
                                                 <option value="{{$persona->id}}" > {{$persona->nombres}} </option>  
                                             @endif 
                                         @endforeach
                                     </select>
                                 </div>
                                 
                                 <div class="form-group" style="margin-top: -10px;">
                                     {!! Form::label('areaPer', 'Area de la persona', ['class' => 'font-weight-bold' ]) !!}
                                     <select class="form-control-sm custom-select text-uppercase select2" name="area" id='area' >
                                         
                                     </select>
                                 </div>
 
                                 <div class="form-group row " id="product1" style="margin-top: -10px;"> 
                                     <div class="form-check ml-4 col-auto">
                                         <input class="form-check-input" type="radio" name="tipod" id="laboral" value="DL" checked>
                                         <label class="form-check-label font-weight-bold" for="gridCheck">Dia laboral</label>
                                     </div>
                                     <div class="form-check ml-4 col-auto"> 
                                         <input class="form-check-input" type="radio" name="tipod" id="descanso" value="V">
                                         <label class="form-check-label font-weight-bold" for="gridCheck">Vacacion</label>
                                     </div>
                                 </div>
                                 
                                 <div class="form-row font-weight-bold " style="margin-top: -10px;">
                                     <div class="form-group col">
                                         <label for="turnoo">Turno</label>
                                         <select name="turno" id="turno" class="form-control-sm custom-select mr-sm-2" >
                                             <option value="" disabled selected>Elegir turno</option>
                                             <option value="Mañana">Mañana</option>
                                             <option value="Tarde">Tarde</option>
                                             <option value="Dia">Dia</option>
                                             <option value="Noche">Noche</option>
                                             <option value="12 Hrs.">12 Hrs.</option>
                                             <option value="24 Hrs.">24 Hrs.</option>
                                         </select>
                                     </div>
                                 </div>
                                 
                                 <div class="form-row font-weight-bold" style="margin-top: -10px;">
                                     <div class="form-group col-md-6">
                                         <label for="fecha de inicio">Fecha Inicio</label>
                                         <input type="date" class="form-control" name="fecha_inicio" id="fec_inicio" >
                                     </div>
                                     <div class="form-group col-md-6">
                                         <label for="fecha de fin">Fecha Fin</label>
                                         <input type="date" class="form-control "  name="fecha_fin" id="fec_fin" disabled>
                                     </div>
                                 </div>
                                 <div class="form-row font-weight-bold" style="margin-top: -10px;">
                                     <div class="form-group col-md-6">
                                         <label for="hora de inicio">Hora Inicio</label>
                                         <input type="time" class="form-control " name="hora_inicio" id="hrs_inicio">
                                     </div>
                                     <div class="form-group col-md-6">
                                         <label for="hora de fin">Hora Fin</label>
                                         <input type="time" class="form-control " name="hora_fin" id="hrs_fin" >
                                     </div>
                                 </div>
 
                                 <div class="form-group row font-weight-bold" style="margin-top: -10px;">
                                     <label class="col">Observaciones</p>
                                     <textarea name="comentario" class="form-control-sm col" placeholder="Este campo es opcional" id="obs"></textarea>
                                 </div>
 
                                 <div class="row justify-content-center align-content-center" style="margin-top: -10px;">
                                     <button id="adicionar" class="btn btn-success btn-sm" type="button"> Agregar</button>
                                     <button id="limpiar" class="btn btn-danger btn-sm ml-4" type="button" > Cancelar</button>                                  
                                 </div>
                             </tr>
                         </table>--}}