
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset("bootstrap4/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset("bootstrap4/js/bootstrap.min.js")}}" type="text/javascript"></script> 
</head>
<body>
    <center>
        <div class="form-group row justify-content-center align-content-center mt-4">
            <h5 class="text-uppercase">INFORME PLANILLA ASISTENCIA DEL PERSONAL DEL SERVICIO DE {{$extras['servicio']}}</h5>
            <h5 class="text-uppercase">CORRESPONDIENTE AL MES DE {{$extras['gestion']}}</h5>
        </div>
    </center>
   
    <div class="container-fluid mt-4">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th width="10%" >Fecha ingreso</th>
                    <th width="10%" >Fecha retorno</th>
                    <th width="4%" >Nro.</th>
                    <th width="22%" >Nombre persona</th>
                    <th width="8%" >Nro. C.I.</th>
                    <th width="10%" >Turno</th>
                    <th width="9%" >Tipo dia</th>
                    <th width="9%" >Hora Entrada</th>
                    <th width="8%" >Hora Salida</th>
                    <th width="" >Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personas as $area => $fechas)
                    <tr>
                        @php $area=\App\Models\areas\Area::where('id',$area)->first(); $vac=1; @endphp
                        <td colspan="10"  style="background-color: #ddd"><strong>{{ $area->nombre }}</strong></td>
                    </tr>
                    @foreach($fechas as $fecha => $personas)
                         
                        @foreach($personas as $key => $persona)
                            <tr>
                                @if($key === 0)
                                    <td rowspan="{{ count($personas) }}">{{ $fecha }}</td>
                                    <td rowspan="{{ count($personas) }}">{{ $persona['fecha_fin'] }}</td>
                                @endif
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $persona['nombre_persona'] }}</td>
                                <td>{{ $persona['ci'] }}</td>
                                <td>{{ $persona['turno'] }}</td>
                                <td>{{ $persona['tipo_dia'] }}</td>
                                <td>{{ $persona['hora_inicio'] }}</td>
                                <td>{{ $persona['hora_fin'] }}</td>
                                <td>{{ $persona['observaciones'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
                <!-- Agregar una fila especial para las personas con fecha_inicio y fecha_fin no nulas -->
                @if(isset($vacaciones))
                    <tr>
                        <td colspan="10"  style="background-color: #ddd"><strong>Otros</strong></td>
                    </tr>
                    @foreach($vacaciones as $vacacion)
                    <tr>
                        <td>{{ $vacacion['fecha_inicio'] }}</td>
                        <td>{{ $vacacion['fecha_fin'] }}</td>
                        <td>{{$vac++}}</td>
                        <td>{{ $vacacion['nombre_persona'] }}</td>
                        <td>{{ $vacacion['ci'] }}</td>
                        <td>{{ $vacacion['turno'] }}</td>
                        <td>{{ $vacacion['tipo_dia'] }}</td>
                        <td>{{ $vacacion['hora_inicio'] }}</td>
                        <td>{{ $vacacion['hora_fin'] }}</td>
                        <td>{{ $vacacion['observaciones'] }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
          {{--
             <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th width="10%" rowspan="2">Fecha ingreso</th>
                    <th width="10%" rowspan="2">Fecha retorno</th>
                    <th width="4%" rowspan="2">Nro.</th>
                    <th width="22%" rowspan="2">Nombre persona</th>
                    <th width="8%" rowspan="2">Nro. C.I.</th>
                    <th width="10%" rowspan="2">Turno</th>
                    {{--<th rowspan="2">Tipo día</th>--}
                    <th width="8%" colspan="2">Horario</th>
                    <th width="" rowspan="2">Observaciones</th>
                </tr>
                <tr>
                    <th>Hora Entrada</th>
                    <th>Hora Salida</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personas as $area => $fechas)
                    <tr>
                        @php $area=\App\Models\areas\Area::where('id',$area)->first(); $vac=1; @endphp
                        <td colspan="10"  style="background-color: #ddd"><strong>{{ $area->nombre }}</strong></td>
                    </tr>
                    @foreach($fechas as $fecha => $personas)
                        @foreach($personas as $key => $persona)
                            <tr>
                                @if($key === 0)
                                    <td rowspan="{{ count($personas) }}">{{ $fecha }}</td>
                                    <td rowspan="{{ count($personas) }}">{{ $persona['fecha_fin'] }}</td>
                                @endif
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $persona['nombre_persona'] }}</td>
                                <td>{{ $persona['ci'] }}</td>
                                <td>{{ $persona['turno'] }}</td>
                                {{--<td>{{ $persona['tipo_dia'] }}</td>--}
                                <td>{{ $persona['hora_inicio'] }}</td>
                                <td>{{ $persona['hora_fin'] }}</td>
                                <td>{{ $persona['observaciones'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
                <!-- Agregar una fila especial para las personas con fecha_inicio y fecha_fin no nulas -->
                @if(isset($vacaciones))
                    <tr>
                        <td colspan="10"  style="background-color: #ddd"><strong>Vacacion</strong></td>
                    </tr>
                    @foreach($vacaciones as $vacacion)
                    <tr>
                        <td>{{ $vacacion['fecha_inicio'] }}</td>
                        <td>{{ $vacacion['fecha_fin'] }}</td>
                        <td>{{$vac++}}</td>
                        <td>{{ $vacacion['nombre_persona'] }}</td>
                        <td>{{ $vacacion['ci'] }}</td>
                        <td>{{ $vacacion['turno'] }}</td>
                        {{--<td>{{ $vacacion['tipo_dia'] }}</td>--}
                        <td>{{ $vacacion['hora_inicio'] }}</td>
                        <td>{{ $vacacion['hora_fin'] }}</td>
                        <td>{{ $vacacion['observaciones'] }}</td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        --}}

        {{--
        <table class="table table-bordered table-striped table-sm">  T2
           
       
                <thead>
                  <tr>
                    <th rowspan="2">Fecha inicio</th>
                    <th rowspan="2">Fecha fin</th>
                    <th rowspan="2">Nro</th>
                    <th rowspan="2">Nombre persona</th>
                    <th rowspan="2">CI</th>
                    <th rowspan="2">Turno</th>
                    <th rowspan="2">Tipo día</th>
                    <th colspan="2">Horario</th>
                    <th rowspan="2">Observaciones</th>
                  </tr>
                  <tr>
                    <th>Entrada</th>
                    <th>Salida</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $area => $fechas)
                  <tr>
                    @php $area=\App\Models\areas\Area::where('id',$area)->first(); $vac=1; @endphp
                    <td colspan="10"  style="background-color: #ddd"><strong>{{ $area->nombre }}</strong></td>
                  </tr>
                  @foreach($fechas as $fecha => $personas)
                  @foreach($personas as $key => $persona)
                  <tr>
                    @if($key === 0)
                    <td rowspan="{{ count($personas) }}">{{ $fecha }}</td>
                    <td rowspan="{{ count($personas) }}">{{ $persona['fecha_fin'] }}</td>
                    @endif
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $persona['nombre_persona'] }}</td>
                    <td>{{ $persona['ci'] }}</td>
                    <td>{{ $persona['turno'] }}</td>
                    <td>{{ $persona['tipo_dia'] }}</td>
                    <td>{{ $persona['hora_inicio'] }}</td>
                    <td>{{ $persona['hora_fin'] }}</td>
                    <td>{{ $persona['observaciones'] }}</td>
                  </tr>
                  @endforeach
                  @endforeach
                  @endforeach
                   <!-- Agregar una fila especial para las personas con fecha_inicio y fecha_fin no nulas -->
                   <tr>
                    <td colspan="10"  style="background-color: #ddd"><strong>Vacacion</strong></td>
                  </tr>
                @foreach($vacaciones as $vacacion)
                    <tr>
                    <td>{{ $vacacion['fecha_inicio'] }}</td>
                    <td>{{ $vacacion['fecha_fin'] }}</td>
                    <td>{{$vac++}}</td>
                    <td>{{ $vacacion['nombre_persona'] }}</td>
                    <td>{{ $vacacion['ci'] }}</td>
                    <td>{{ $vacacion['turno'] }}</td>
                    <td>{{ $vacacion['tipo_dia'] }}</td>
                    <td>{{ $vacacion['observaciones'] }}</td>
                    </tr>
                @endforeach
                </tbody>
              </table>
              

              public function print3($id) //no usado esto la funcion del controlador
                {
                    $turnos = PersonaRolturno::orderBy('fecha_inicio')
                        ->orderBy('hora_inicio')
                        ->orderBy('area_id')
                        ->where('rolturno_id',$id)->get();

                        $data = array();
                        $vacaciones = array();

                        foreach ($turnos as $turno) {
                            $area = $turno->area_id;
                        
                            if (!array_key_exists($area, $data)) {
                                $data[$area] = array();
                            }
                        
                            $fechaInicio = null;
                        
                            $persona = array(
                                'nombre_persona' => $turno->rolturno_per->nombres,
                                'ci' => $turno->rolturno_per->ci,
                                'tipo_dia' => $turno->tipo_dia,
                                'hora_inicio' => $turno->hora_inicio,
                                'hora_fin' => $turno->hora_fin,
                                'turno' => $turno->tipoTurno->nombre,
                                'observaciones' => $turno->obs,
                                'fecha_fin' => $turno->fecha_fin
                            );
                        
                            if ($fechaInicio !== $turno->fecha_inicio) {
                                $fechaInicio = $turno->fecha_inicio;
                        
                                $data[$area][$fechaInicio][] = $persona;
                            } else {
                                $data[$area][$fechaInicio][] = $persona;
                            }

                            // Verificar si es una persona en vacaciones
                            if ($turno->fecha_inicio !== null && $turno->fecha_fin != $turno->fecha_inicio && $turno->fecha_fin !== null) {
                                $vacaciones[] = [
                                    'fecha_inicio' => $turno->fecha_inicio,
                                    'fecha_fin' => $turno->fecha_fin,
                                    'nombre_persona' => $turno->rolturno_per->nombres,
                                    'ci' => $turno->rolturno_per->ci,
                                    'turno' => $turno->tipoTurno->nombre,
                                    'tipo_dia' => $turno->tipo_dia,
                                    'observaciones' => $turno->obs,
                                    'area' => $turno->area_id
                                ];
                            }
                        }
                        
                    // Enviar los datos a la vista
                    return view('rolturnos.ImprimirRolturnos', compact('data', 'vacaciones'));
                
                }
              
              
              --}}

    </div>
</body>
</html>
