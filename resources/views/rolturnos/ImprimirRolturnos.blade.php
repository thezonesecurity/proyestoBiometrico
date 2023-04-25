
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
    <div class="container-fluid mt-4">
    <table class="table table-bordered table-striped table-sm">
        <thead>
          <tr>
            <th width="1%">Nro.</th>
                <th style="text-align: center;" width="9%">Persona</th>
                <th style="text-align: center;" width="8%">Area</th>
                <th style="text-align: center;" width="4%">Tipo dia</th>
                <th style="text-align: center;" width="5%">Fecha ini</th>
                <th style="text-align: center;" width="5%">Fecha fin</th>
                <th style="text-align: center;" width="5%">Hora Ingreso </th>
                <th style="text-align: center;" width="5%">Hora Salida</th>
                <th style="text-align: center;" width="5%">turno</th>
                <th style="text-align: center;" width="6%">Observacion</th>
          </tr>
        </thead>
        <tbody> <?php  $i=0; ?>
            @foreach ($per_rolturnos as $rolturno)
                @if($rolturno->estado == 'Habilitado')   
                    <tr>
                        <td>{{++$i}}</td>
                        <td><span id="" >{{$rolturno->rolturno_per->nombres}}</span></td>
                        @php $area=\App\Models\areas\Area::where('id',$rolturno->area_id)->first(); @endphp
                        <td><span id="" >{{$rolturno->area->nombre}}</span></td>
                        <td><span id="" >{{$rolturno->tipo_dia}}</span></td>
                        <td><span id="" >{{$rolturno->fecha_inicio}}</span></td>
                        <td><span id="" >{{$rolturno->fecha_fin}}</span></td>
                        <td><span id="" >{{$rolturno->hora_inicio}}</span></td>
                        <td><span id="" >{{$rolturno->hora_fin}}</span></td>
                        <td><span id="" >{{$rolturno->turno}}</span></td>
                        <td><span id="" >{{$rolturno->obs}}</span></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
      </table>
    </div>
</body>
</html>
