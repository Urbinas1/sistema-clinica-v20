<div class="modal fade" id="modal-delete">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- <form action="./controller/o-04-D-modal-f.php" method="POST"> -->

        <div class="modal-header">
          <h4 class="modal-title">Eliminar Doctor<?php echo $singular; ?><img src="../dist/img/icons8-eliminar.gif" ></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">          
          <input type="hidden" class="form-control" name="id" id="delete_id">
          <p>Esta seguro que quiere eliminar este Doctor</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="button" onclick="deleteL()" class="btn btn-danger" name="delete" >Eliminar</button>
        </div>

      <!-- </form> -->

    </div>
  </div>
</div>