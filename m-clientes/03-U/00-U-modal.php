<div class="modal fade" id="modal-update">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Actualizar <?php echo $singular; ?> (Paciente)</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <input type="hidden" class="form-control" name="id" id="edit_id">

        <div class="form-group row">
          <label for="edit_description" class="col-sm-3 col-form-label">atencion</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="description" id="edit_description" placeholder="campo1">
          </div>
        </div>

        <div class="form-group row">
          <label for="edit_seguro" class="col-sm-3 col-form-label">Seguro</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="edit_seguro" name="seguro" placeholder="Numero de Seguro">
          </div>
        </div>

        <div class="form-group row">
          <label for="edit_poliza" class="col-sm-3 col-form-label"># Poliza</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="edit_poliza" name="poliza" placeholder="Numero de poliza">
          </div>
        </div>   
        
        <div class="form-group row">
          <label for="edit_rtn" class="col-sm-3 col-form-label">Rtn</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="edit_rtn" name="rtn" placeholder="Numero de Rtn">
          </div>
        </div>

        <div class="form-group row">
          <label for="edit_certificado" class="col-sm-3 col-form-label">Certificado</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="edit_certificado" name="certificado" placeholder="Certificado">
          </div>
        </div>

        <div class="form-group row">
          <label for="edit_identidad" class="col-sm-3 col-form-label">Identidad</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="identidad" id="edit_identidad" placeholder="codigo de identidad">
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="update()" name="update" class="btn btn-success">Guardar cambios</button>
      </div>
      <!-- </form> -->

    </div>
  </div>
</div>