<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset("bootstrap4/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset("bootstrap4/js/bootstrap.min.js")}}" type="text/javascript"></script> 
</head>
<body>
    <div class="container-fluid mt-3">
        <div class="form-group row justify-content-center align-content-center">
            <h3>INFORME PLANILLA DE ASISTENCIA DEL PERSONAL DEL SERVICIO DE FARMACIA</h3><br>
            <h4>CORRESPONDIENTE AL MES DE FEBRERO DEL 2023</h4>
        </div>
       
        
        <table class="table table-sm table-striped border">
          <thead>
              <tr>
                  <th>Nro</th>
                  <th>Nombre Persona</th>
                  <th>Área</th>
                  <th>Turno</th>
                  <th>Hora</th>
                  @foreach ($diasMes as $dia)
                      <th>{{ $dia }}</th>
                  @endforeach
              </tr>
          </thead>
          <tbody>
              @foreach ($rolTurnos as $key => $rolTurno)
                  @if ($key == 0 || $rolTurno->rolturno_per->nombres != $rolTurnos[$key - 1]->rolturno_per->nombres)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $rolTurno->rolturno_per->nombres }}</td>
                          <td>{{ $rolTurno->area->nombre }}</td>
                          <td>{{ $rolTurno->tipoTurno->nombre }}</td>
                          <td>{{ $rolTurno->hora_inicio }} - {{ $rolTurno->hora_fin }}</td>
                          @foreach ($fechasMes as $fecha)
                              @if ($rolTurno->fecha_inicio == $fecha)
                                  <td>A</td>
                              @else
                                  <td>F</td>
                              @endif
                          @endforeach
                      </tr>
                  @endif
              @endforeach
          </tbody>
      </table>
      
    </div>
</body>
</html>