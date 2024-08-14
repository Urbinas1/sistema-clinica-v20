<div class="modal fade" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Crear <?php echo $singular; ?> (Paciente)</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group row">
          <label for="description" class="col-sm-3 col-form-label">Nombre</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="description" id="description" placeholder="Nombre paciente">
          </div>
        </div>
        <div class="form-group row">
          <label for="seguro" class="col-sm-3 col-form-label">Seguro del Paciente</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="seguro" id="seguro" placeholder="Seguro del Paciente">
          </div>
        </div>
        <div class="form-group row">
          <label for="poliza" class="col-sm-3 col-form-label"># Poliza</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="poliza" id="poliza" placeholder="Numero de poliza">
          </div>
        </div>
        <div class="form-group row">
          <label for="certificado" class="col-sm-3 col-form-label">Certificado</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="certificado" id="certificado" placeholder="Certificado">
          </div>
        </div>
        <div class="form-group row">
          <label for="rtn" class="col-sm-3 col-form-label">RTN</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="rtn" id="rtn" placeholder="rtn">
          </div>
        </div>
        <div class="form-group row">
          <label for="identidad" class="col-sm-3 col-form-label">Identidad</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="identidad" id="identidad" placeholder="codigo de identidad">
          </div>
        </div>
      </div>

      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="add" onclick="create()" class="btn btn-success">Guardar</button>
      </div>

    </div>
  </div>
</div>
