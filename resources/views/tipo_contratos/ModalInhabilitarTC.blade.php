
  <div class="modal fade" id="abrirModalInhabilitarTC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Verificacion para Habilitacion / Deshabilitacion tipo de contratos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['route' => 'inhabilitar.tipo.contrato', 'method' => 'post']) !!}
                <div class="text-center font-weight-bold">
                  <img src="{{asset('assets/img/ad.JPG')}}" width="250" height="190" class="rounded mx-auto d-block"/>
                  <h4>Esta seguro de realizar alguna accion ?</h4>
                </div>
                <input type="hidden" name="id" id="idMI">
                <p style="font-size: 15px;" class="mt-3">
                  Se <span id="dato" class="font-weight-bold"></span> el tipo de contrato <span id="tipocMI" class="font-weight-bold"></span>. Esta seguro?
                </p>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success controlH" name="accion" value="H" style="display: none">Habilitar</button>{{--style="display: none"--}}
                  <button type="submit" class="btn btn-danger controlI" name="accion" value="D" style="display: none">Deshabilitar</button>
                  <button type="reset" class="btn btn-secondary" id="cancelarBtn" data-dismiss="modal">Cancelar</button>
                </div>
            {!! Form::close() !!}  
        </div>
      </div>
    </div>
  </div>