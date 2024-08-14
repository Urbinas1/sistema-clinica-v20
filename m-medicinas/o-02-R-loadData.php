<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-create"><i class="fa fa-plus"></i>
           Creacion del Medicamento</button>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../m-inicio/index.php"><?php echo $appName; ?></a></li>
            <li class="breadcrumb-item active"><?php echo $moduleName; ?></li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Lista de Medicamentos.</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped" style="width: 100%;">
                <thead>
                  <tr> 
                    <!-- <th>id</th> -->
                    <th> <img src="../dist/img/icons8-vaccine-64.png"  alt="">Descripcion del Medicamento. </th> 
                    <th> <img src="../dist/img/icons8-trolley-64.png"  alt="">Cantidad del Medicamento. </th> 
                    <th> <img src="../dist/img/icons8-precio.gif"   alt="">Precio del Medicamento </th> 
                    <!-- <th>status</th>
                    <th>created</th> -->
                    <th> <img src="../dist/img/icons8-settings-64.png"  alt="">Opciones.</th> 
                  </tr>
                </thead>
              </table>
            </div>
          </div>


        </div>
      </div>
    </div>

  </section>

</div>