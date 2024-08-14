<div class="modal fade" id="modal-add-cliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Paciente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Paciente: </label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" id="selectClientes" required data-dropdown-css-class="select2-danger" style="width: 100%;">
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" onclick="updateIdClient()" name="add" name="add" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modal-add-doctor1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Doctor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Doctor</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" id="selectDoctores" required data-dropdown-css-class="select2-danger" style="width: 100%;">
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" onclick="updateDoctor1Id()" name="add" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-add-doctor2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar Doctor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Doctor</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" id="selectDoctores1" required data-dropdown-css-class="select2-danger" style="width: 100%;">
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" onclick="updateDoctor2Id()" name="add" class="btn btn-primary">Agregar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modal-add-opcion">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">TIPO FACTURACION</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">TIPO</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" id="selectOption" required data-dropdown-css-class="select2-danger" style="width: 100%;">
              <option selected value="0">SELECCIONE CREDITO O CONTADO</option>
              <option value="1">CREDITO</option>
              <option value="2">CONTADO</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" onclick="tipoFactura()" name="add" class="btn btn-primary">Agregar</button>
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
        <button type="submit" onclick="addAtt()" class="btn btn-primary">Agregar</button>
      </div>

    </div>

  </div>

</div>


<div class="modal fade" id="modal-add-hospitalizacion">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Agregar una Hospitalizacion</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Descripcion</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" id="selectHospitalizacion" required data-dropdown-css-class="select2-danger" style="width: 100%;">
            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" onclick="addHospitalizacion()" class="btn btn-primary">Agregar</button>
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
          <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" value="1" name="cantidad" id="cantidad" placeholder="campo2">
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" onclick="addMed()" name="add" class="btn btn-primary">Agregar</button>
      </div>

    </div>

  </div>

</div>





<div class="modal fade" id="modal-add-mat">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Agregar Material</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Material</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" id="selectMat" required data-dropdown-css-class="select2-danger" style="width: 100%;">
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" value="1" name="cantidad" id="cantidadMat" placeholder="CANTIDAD">
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" onclick="addMat()" name="add" class="btn btn-primary">Agregar</button>
      </div>

    </div>

  </div>

</div>



<!-- MODAL PARA ATENCION AL CLIENTE -->

<div class="modal fade" id="modal-add-atCliente">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Agregar Sala Cuna</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Atencion</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" id="selectAteCliente" required data-dropdown-css-class="select2-danger" style="width: 100%;">
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="cantidadat" class="col-sm-2 col-form-label">Cantidad</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" value="1" name="cantidadat" id="cantidadat" placeholder="campo2">
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" onclick="addatCliente()" name="add" class="btn btn-primary">Agregar</button>
      </div>

    </div>

  </div>

</div>









<div class="modal fade" id="modal-add-categorias">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Agregar Categoria</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="form-group row">
          <label for="description" class="col-sm-2 col-form-label">Categoria</label>
          <div class="col-sm-10">
            <select class="form-control select2 select2-danger" id="selectCategoria" required data-dropdown-css-class="select2-danger" style="width: 100%;">
              <option value="" selected>SELECCIONE UNA CATEGORIA</option>
              <option value="1" >ATENCIÓN EN LA EMERGENCIA</option>
              <option value="2" >MEDICINAS Y SUMINISTROS</option>
              <!-- SE AGREGA DE FORMA MANUAL LA CATEGORIA EN EL LISTADO -->
              <option value="3" >SALA CUNA</option>
              <option value="4" >MATERIALES QUIRURGICOS</option>
              <option value="5" >HOSPITALIZACION</option>

            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" onclick="updateCat()" class="btn btn-primary">Agregar</button>
      </div>

    </div>

  </div>

</div>