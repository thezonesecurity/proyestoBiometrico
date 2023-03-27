de editarPersonal 
<form action="">
    <div class="form-group">
        {!! Form::label('servicioPer', 'servicio de la persona', ['class' => 'font-weight-bold' ]) !!}
       {{-- {!! Form::text('servicio','' , ['class' => 'form-control' , 'required' => 'required', 'id'=>"servicioM"]) !!} --}}
       <select class="js-example-basic-single form-control custom-select" name="servicio" id='servicioM' required="true">
        <option value="" disabled>Elegir un servicio</option> 
        @foreach($servi as $item)
            @if($item->estado == 'Habilitado')
                <option value="{{$item->nombre}}" selected >
                    {{$item->nombre}}
                </option>  
            @endif                       
        @endforeach
    </select>
    </div>

    <div class="form-group">
        {!! Form::label('areaPer', 'Area de la Persona', ['class' => 'font-weight-bold' ]) !!}
        {!! Form::text('area','' , ['class' => 'form-control' , 'required' => 'true', 'id'=>"per_areaM", 'pattern'=>"[A-Za-z ]{5,60}"]) !!}
    </div>
</form>


del controlador metodo update
dd($request);
// dd($request->id_user);
 $persona=Persona::where('idper_db',$request->id_user)->first(); 
 //dd($persona);
 $serv= DB::select("select * from repbio.servicios where nombre = '$request->servicio' ");
 $id_servi = $serv[0]->id;
 $area_per = ucwords($request->area);
    //dd($id_servi);
 if($persona){
    // echo 'existe en DB';
     $persona->area = $area_per;
     $persona->item = $request->item;
     $persona->estado_per = 'Habilitado';
     $persona->idper_db = $request->id_user;
     $persona->id_servicio = $id_servi; 
     //dd($persona);
     $persona->save();
     return redirect(route('listar.personal'));
 }
 else {
     //echo 'NO existe en DB';
     $persona = new Persona;
     $persona->area = $area_per;;
     $persona->item = $request->item;
     $persona->estado_per = 'Habilitado';
     $persona->idper_db = $request->id_user;
     $persona->id_servicio = $id_servi; 
    // dd($persona);
     $persona->save();
     return redirect(route('listar.personal'));
 }
