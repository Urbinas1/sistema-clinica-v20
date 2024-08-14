<div class="modal fade" id="modal-update">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      
    <!-- <form action="./controller/o-03-U-modal-f.php" method="POST"> -->

        <div class="modal-header">
          <h4 class="modal-title">Actualizar  <?php echo $singular; ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        
        <input type="hidden" class="form-control" name="id" id="edit_<?php echo $field0;?>">

          <div class="form-group row">
            <label for="edit_<?php echo $field1;?>" class="col-sm-3 col-form-label"><?php echo $campo1;?><img src="../dist/img/icons8-x-ray-40.png" ></label>
            <div class="col-md-8 ml-md-auto">
              <input type="text" class="form-control" name="description" id="edit_<?php echo $field1;?>" placeholder="<?php echo $campo1;?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="edit_<?php echo $field2;?>" class="col-sm-3 col-form-label"><?php echo $campo2;?><img src="../dist/img/signo-medico1.png" ></label>
            <div class="col-md-8 ml-md-auto">
              <input type="text" class="form-control" id="edit_<?php echo $field2;?>" name="poliza"  placeholder="<?php echo $campo2;?>">
            </div>
          </div>

          <div class="form-group row">
            <label for="edit_<?php echo $field3;?>" class="col-sm-3 col-form-label"><?php echo $campo3;?><img src="../dist/img/icons8-teléfono-celular-40.png" ></label>
            <div class="col-md-8 ml-md-auto">
              <input type="text" class="form-control"  id="edit_<?php echo $field3;?>"  name="certificado" placeholder="<?php echo $campo3;?>">
            </div>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" onclick="update()" name="update" class="btn btn-success">Guardar</button>
        </div>
      <!-- </form> -->

    </div>
  </div>
</div>