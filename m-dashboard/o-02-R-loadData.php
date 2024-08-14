<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

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

          <div class="invoice p-3 mb-3">

            <div class="row">
              <div class="col-12">
                <h4>
                  <i class="fas fa-globe"></i> POLICLINICA SAN RAFAEL.
                </h4>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">

                <div class="card card-danger">
                  <div class="card-header">
                    <h3 class="card-title">Seleccione un Rango de Fechas</h3>
                  </div>
                  <div class="card-body">
                    <div class="form-group">

                      <div class="input-group">
                        <button type="button" class="btn btn-default btn-block" id="daterange-btn" onclick="showDate()">
                          <i class="far fa-calendar-alt"></i> CALENDARIO
                          <i class="fas fa-caret-down"></i>
                        </button>
                      </div>

                      
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Rango seleccionado</h3>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <input type="text" class="form-control float-right" id="reservationx">
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </div>


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Reporte</h3>
              </div>

              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" style="width: 100%;" >
                  <thead>
                    <tr>
                      <th>N</th>
                      <th>Poliza</th>
                      <th>Certificado</th>
                      <th>Factura</th>
                      <th>Fecha</th>
                      <th>Asegurado</th>
                      <th>SUBTOTAL</th>
                      <th>DESCU(%)</th>
                      <th>OTROSDES</th>
                      <th>TOTAL</th>
                      <th>Copago(%)</th>

                      <th>NOELEGIB</th>
                      <th>DEDUCIBL</th>
                      <th>TOTALPAG</th>
                      
                      <th>Opciones</th>
                    </tr>
                  </thead>
                </table>

                <h4 style="color: orange; text-align: right;">
                  <strong>
                    <b>
                      <span class="badge badge-warning " id="total" >
                        TOTAL:.... L. --,--.00
                      </span>
                    </b>
                  </strong>
                </h4>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>