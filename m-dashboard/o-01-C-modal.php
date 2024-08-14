

<div class="modal fade" id="modal-add-cliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar un Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Doctor</label>
          <div class="col-sm-10">
          <!-- <select class="form-control select2 select2-danger" id="selectClientes" required data-dropdown-css-class="select2-danger" style="width: 100%;">              
            </select> -->
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="add" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modal-add-doctor">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar un Doctor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Doctor</label>
          <div class="col-sm-10">
          <!-- <select class="form-control select2 select2-danger" id="selectDoctores" required data-dropdown-css-class="select2-danger" style="width: 100%;">              
            </select> -->
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="add" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>







<div class="modal fade" id="modal-add-atencion">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Agregar una Atencion</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Descripcion</label>
          <div class="col-sm-10">
          <select class="form-control select2 select2-danger" id="selectAtencion" required data-dropdown-css-class="select2-danger" style="width: 100%;">              
            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="add" class="btn btn-primary">Agregar</button>
      </div>

    </div>

  </div>

</div>




<div class="modal fade" id="modal-add-medicinas">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Agregar Medicina</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Medicina</label>
          <div class="col-sm-10">
          <select class="form-control select2 select2-danger" id="selectMedicinas" required data-dropdown-css-class="select2-danger" style="width: 100%;">              
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="quantity" class="col-sm-2 col-form-label">Cantidad</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="campo2">
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" name="add" class="btn btn-primary">Agregar</button>
      </div>

    </div>

  </div>

</div>