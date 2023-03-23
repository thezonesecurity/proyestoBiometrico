<div class="modal fade" id="ModalEditar" tabindex="-1" role="dialog" aria-labelledby="ModalEditarLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Rol Turno</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" id="lista" >
          <input type="text"  name="id_per" id="update_id">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label font-weight-bold">Persona</label>
            <input name="persona" id="persona" type="text" class="form-control" >
          </div>
         
        <div class="form-group row justify-content-center align-content-center" id="product1">
            <div class="form-check ml-5 col-auto">
                <input class="form-check-input" type="radio" name="tipod" id="laboral" value="DL" checked>
                <label class="form-check-label font-weight-bold" for="gridCheck">Dia laboral</label>
            </div>
            <div class="form-check ml-5 col-auto"> 
                <input class="form-check-input" type="radio" name="tipod" id="descanso" value="V">
                <label class="form-check-label font-weight-bold" for="gridCheck">Vacacion</label>
            </div>
        </div>
        
        <div class="form-row font-weight-bold">
            <div class="form-group col-md-6">
                <label for="fecha de inicio">Fecha Inicio</label>
                <input type="date" class="form-control" name="fec_inicio" id="fec_inicio" >
            </div>
            <div class="form-group col-md-6">
                <label for="fecha de fin">Fecha Fin</label>
                <input type="date" class="form-control "  name="fec_fin" id="fec_fin">
            </div>
        </div>
        <div class="form-row font-weight-bold">
            <div class="form-group col-md-6">
                <label for="hora de inicio">Hora Inicio</label>
                <input type="time" class="form-control " name="hrs_ini" id="hrs_ini">
            </div>
            <div class="form-group col-md-6">
                <label for="hora de fin">Hora Fin</label>
                <input type="time" class="form-control " name="hrs_fin" id="hrs_fin" >
            </div>
        </div>
    
        <div class="form-row font-weight-bold ">
            <div class="form-group col">
                <label for="turnoo">Turno</label>
                <select name="turno" id="turno" class="form-control custom-select mr-sm-2" >
                    <option value="" disabled selected>Elegir turno</option>
                    <option value="Mañana">Mañana</option>
                    <option value="Tarde">Tarde</option>
                    <option value="Dia">Dia</option>
                    <option value="Noche">Noche</option>
                    <option value="24 Hrs.">24 Hrs.</option>
                </select>
            </div>
        </div>

        <div class="form-group row font-weight-bold">
            <label class="col">Area</p>
            <input name="area" id="area" type="text" class="form-control" >
        </div>

        <div class="form-group row font-weight-bold">
            <label class="col">Observaciones</p>
            <textarea name="obs" id="obs" class="form-control col" placeholder="Este campo es opcional"></textarea>
        </div>
        </form>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary guardarModal">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

