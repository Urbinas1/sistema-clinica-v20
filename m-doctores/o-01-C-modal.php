<div class="modal fade" id="modal-create">
<div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Crear <?php echo $singular; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group row">
          <label for="<?php echo $field1; ?>" class="col-sm-3 col-form-label"><?php echo $campo1; ?><img src="../dist/img/icons8-x-ray-40.png" ></label>
          <div class="col-md-8 ml-md-auto">
            <input type="text" class="form-control" name="<?php echo $field1; ?>" id="<?php echo $field1; ?>" placeholder="<?php echo $campo1; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="<?php echo $field2; ?>" class="col-sm-3 col-form-label"><?php echo $campo2; ?><img src="../dist/img/signo-medico1.png" ></label>
          <div class="col-md-8 ml-md-auto">
            <input type="text" class="form-control" name="<?php echo $field2; ?>" id="<?php echo $field2; ?>" placeholder="<?php echo $campo2; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="<?php echo $field3; ?>" class="col-sm-3 col-form-label"><?php echo $campo3; ?><img src="../dist/img/icons8-teléfono-celular-40.png" ></label>
          <div class="col-md-8 ml-md-auto">
            <input type="text" class="form-control" name="<?php echo $field3; ?>" id="<?php echo $field3; ?>" placeholder="<?php echo $campo3; ?>">
          </div>
        </div>
      </div>

      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="add" onclick="create()" class="btn btn-success">Guardar</button>
      </div>

    </div>
  </div>
</div>