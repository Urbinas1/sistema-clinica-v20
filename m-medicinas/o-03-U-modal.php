<div class="modal fade" id="modal-update">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="./controller/o-03-U-modal-f.php" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Actualizar Medicamento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        <input type="hidden" class="form-control" name="table" id="edit_table" value="<?php echo $table; ?>">
        <input type="hidden" class="form-control" name="id" id="edit_id">

          <div class="form-group row">
            <label  for="edit_description" >Descripcion del Medicamento. <img src="../dist/img/medicinas.png" ></label>  
            <div class="col-md-8 ml-md-auto">
              <input type="text" class="form-control" name="description" id="edit_description" placeholder="Nombre del Medicamento.">
            </div>
          </div>

          <div class="form-group row">
            <label for="edit_quantity" >Cantidad de Medicamento. <img src="../dist/img/inventario.png" ></label>
            <div class="col-md-8 ml-md-auto">
              <input type="number" min="0.00" max="99999.99" step="0.01" class="form-control" name="Quantity" id="edit_quantity" placeholder="Cantidad de Medicamento.">
            </div>
          </div>

          <div class="form-group row">
            <label for="edit_price" >Precio de Medicamento. <img src="../dist/img/icons8-precio.gif"></label>
            <div class="col-md-8 ml-md-auto">
              <input type="number" min="0.00" max="99999.99" step="0.01" class="form-control" name="price" id="edit_price" placeholder="Precio de Medicamento.">
            </div>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" name="update" class="btn btn-success">Guardar Cambios</button>
        </div>
      </form>
    </div>

  </div>

</div>