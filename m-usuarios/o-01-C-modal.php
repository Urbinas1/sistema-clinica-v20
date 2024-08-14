<div class="modal fade" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Crear <?php echo $singular; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="form-group row">
          <label for="<?php echo $field1; ?>" class="col-sm-3 col-form-label"><?php echo $campo1; ?></label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="<?php echo $field1; ?>" id="<?php echo $field1; ?>" placeholder="<?php echo $campo1; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="<?php echo $field2; ?>" class="col-sm-3 col-form-label"><?php echo $campo2; ?></label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="<?php echo $field2; ?>" id="<?php echo $field2; ?>" placeholder="<?php echo $campo2; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="<?php echo $field3; ?>" class="col-sm-3 col-form-label"><?php echo $campo3; ?></label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="<?php echo $field3; ?>" id="<?php echo $field3; ?>" placeholder="<?php echo $campo3; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="<?php echo $field6; ?>" class="col-sm-3 col-form-label"><?php echo $campo6; ?></label>
          <div class="col-sm-9">

            <select class="form-control select2 select2-danger" id="<?php echo $field6; ?>" required data-dropdown-css-class="select2-danger" style="width: 100%;">
              <option selected value="">TIPO USUARIO (SELECCIONAR)</option>
              <option value="1">ADMINISTRADOR</option>
              <option value="2">DOCTOR</option>
              <option value="3">CLIENTE (PACIENTE)</option>
            </select>

          </div>
        </div>


        <div class="form-group row">
          <label for="<?php echo $field7; ?>" class="col-sm-3 col-form-label"><?php echo $campo7; ?></label>
          <div class="col-sm-9">
            <input type="text" class="form-control" require name="<?php echo $field7; ?>" id="<?php echo $field7; ?>" placeholder="<?php echo $campo7; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="<?php echo $field8; ?>" class="col-sm-3 col-form-label"><?php echo $campo8; ?></label>
          <div class="col-sm-9">
            <input type="password" class="form-control" require name="<?php echo $field8; ?>" id="<?php echo $field8; ?>" placeholder="<?php echo $campo8; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="photo" class="col-sm-3 col-form-label">FOTO</label>
          <div class="col-sm-9 custom-file">
            <input type="file" class="form-control custom-file-input" id="photo" name="photo"  placeholder="FOTO">
            <label class="custom-file-label" for="exampleInputFile">Seleccione una Foto</label>
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