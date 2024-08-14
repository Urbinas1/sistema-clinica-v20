<div class="modal fade" id="modal-update">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- <form action="./controller/o-03-U-modal-f.php" method="POST"> -->

      <div class="modal-header">
        <h4 class="modal-title">Actualizar <?php echo $singular; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <input type="hidden" class="form-control" name="id" id="edit_<?php echo $field0; ?>">

        <div class="form-group row">
          <label for="edit_<?php echo $field1; ?>" class="col-sm-3 col-form-label"><?php echo $campo1; ?></label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="description" id="edit_<?php echo $field1; ?>" placeholder="<?php echo $campo1; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="edit_<?php echo $field2; ?>" class="col-sm-3 col-form-label"><?php echo $campo2; ?></label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="edit_<?php echo $field2; ?>" name="poliza" placeholder="<?php echo $campo2; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="edit_<?php echo $field3; ?>" class="col-sm-3 col-form-label"><?php echo $campo3; ?></label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="edit_<?php echo $field3; ?>" name="certificado" placeholder="<?php echo $campo3; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="<?php echo $field6; ?>" class="col-sm-3 col-form-label"><?php echo $campo6; ?></label>
          <div class="col-sm-9">

            <select class="form-control select2 select2-danger" id="edit_<?php echo $field6; ?>" required data-dropdown-css-class="select2-danger" style="width: 100%;">
              <option value="">TIPO USUARIO (SELECCIONAR)</option>
              <option value="1">ADMINISTRADOR</option>
              <option value="2">DOCTOR</option>
              <option value="3">CLIENTE (PACIENTE)</option>
            </select>

          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" onclick="update()" name="update" class="btn btn-success">Guardar cambios</button>
      </div>


    </div>
  </div>
</div>



<div class="modal fade" id="modal-edit-picture">
  <div class="modal-dialog">
    <div class="modal-content">



      <div class="modal-header">
        <h4 class="modal-title">Editar foto </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="card-body">

        <input type="hidden" id="edit_photo_id">

        <div class="form-group row">
          <label for="edit_photo" class="col-sm-3 col-form-label">FOTO</label>
          <div class="col-sm-9 custom-file">
            <input type="file" class="form-control custom-file-input" id="edit_photo" name="edit_photo"  placeholder="FOTO">
            <label class="custom-file-label" for="exampleInputFile">Seleccione una Foto</label>
          </div>
        </div>

      </div>


      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" onclick="updateP()" class="btn btn-primary">Salvar</button>
      </div>





    </div>
  </div>
</div>