<div class="modal fade" id="modal-create">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="./controller/o-02-C-modal-f.php" method="POST">
        <div class="modal-header">
          <h4 class="modal-title">Crear de Medicamento</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <input type="hidden" class="form-control" name="table" id="table" value="<?php echo $table; ?>">

          <div class="form-group row">
            <label for="Description" >Medicamentos. <img src="../dist/img/medicinas.png" ></label>
            <div class="col-md-8 ml-md-auto">
              <input type="text" class="form-control" name="Description" id="Description" placeholder="Nombre del Medicamento.">
            </div>
          </div>

          <div class="form-group row">
            <label for="Quantity" >Cantidad de Medicamento. <img src="../dist/img/inventario.png" ></label>
            <div class="col-md-8 ml-md-auto">
              <input type="number" min="0.00" max="99999.99" step="0.01" class="form-control" name="Quantity" id="Quantity" placeholder="Cantidad de Medicamento.">
            </div>
          </div>

          <div class="form-group row">
            <label for="Price" >Precio de Medicamento.  <img src="../dist/img/icons8-precio.gif"></label>
            <div class="col-md-8 ml-md-auto">
              <input type="number" min="0.00" max="99999.99" step="0.01" class="form-control" name="Price" id="Price" placeholder="Precio de Medicamento.">
            </div>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" name="add" class="btn btn-success">Guardar</button>
        </div>
      </form>
    </div>

  </div>

</div>