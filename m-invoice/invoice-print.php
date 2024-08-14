<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Invoice Print</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../plugins/sweetalert2/sweetalert2.min.css">

  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body>
  <div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-12">
          <h2 class="page-header">
            <i class="fas fa-globe"></i> POLICLINICA SAN RAFAEL.
            <input type="hidden" id="ultimaFactura" value="<?php echo $_GET['id'] ?>">

            <small class="float-right">Date: 2/10/2014</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From
                <address>
                  <strong>POLICLINICA SAN RAFAEL.</strong><br>
                  Calle Vicente Williams<br>
                  Salida a Marcovia<br>
                  Teléfono: +(504) 2782-0261<br>
                  Choluteca,Honduras, C.A.
                </address>
              </div>

              <div class="col-sm-4 invoice-col">
                <b>FACTURAR A</b>
                <address>
                  <strong>
                    <div class="input-group input-group-sm col-sm-12">
                      <input type="text" disabled readonly id="nombreCliente" class="form-control">
                    
                    </div>
                  </strong>
                  <br>
                  <b>IDENTIDAD . . ..</b>

                  <span class="badge badge-warning text-md" id="identidad">0000-0000-0000 ........</span>
                  <br><br>
                  <b> ASEGURADORA </b>
                  <span class="badge badge-warning text-md" id="aseguradora">SEGUROS XXXXX ..</span>
                </address>
              </div>

              <div class="col-sm-4 invoice-col">
                <b>Factura: <span class="badge text-md badge-warning" id="ultimaFact"># 00000<?php echo $_GET['id'] ?> </span> </b><br>
                <br>
                <b>1. MÉDICO TRATANTE: </b>

                <div class="input-group input-group-sm col-sm-11">

                  <!-- <select class="form-control select2 select2-danger" id="selectDoctores" required data-dropdown-css-class="select2-danger" style="width: 100%;">
                  </select> -->

                  <input type="text" disabled readonly id="nombreDoctor1" class="form-control">
              

                </div>

                <b>2. MÉDICO TRATANTE: </b>

                <div class="input-group input-group-sm col-sm-11">



                  <input type="text" disabled readonly id="nombreDoctor2" class="form-control">
                 

                </div>


                <b>TIPO FACTURACION</b><br>
                <div class="input-group input-group-sm col-sm-11">
                  <input type="text" disabled readonly id="nombreOpcion" class="form-control">
                 
                </div>
              </div>
            </div>
      <!-- /.row -->



      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped" id="example1">
            <thead>
              <tr>
                <th>DESCRIPCIÓN</th>
                <th>TOTAL</th>
                <th>CUBRE PACIENTE</th>
                <th>CUBRE ASEGURADORA</th>
                
              </tr>
            </thead>
          </table>
          <h4 style="color: orange; text-align: right;">
            <strong>
              <b>
                <span class="badge badge-warning " id="total1">
                  SUB TOTAL: L ----.00
                </span>
              </b>
            </strong>
          </h4>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <hr>

      <!-- Table row -->
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped" id="example2">
            <thead>
              <tr>
                <th>DESCRIPCIÓN</th>
                <th>CANT</th>
                <th>TOTAL</th>
                <th>CUBRE PACIENTE</th>
                <th>CUBRE ASEGURADORA</th>
                
              </tr>
            </thead>
          </table>
          <h4 style="color: orange; text-align: right;"> <strong>
              <b>
                <span class="badge badge-warning " id="total2">
                  SUB TOTAL:L ----.00
                </span>

              </b>
            </strong>
          </h4>
        </div>
        <!-- /.col -->
      </div>





      <div class="row">

        <div class="col-6">
          <p class="lead">Metodos de Pagos:</p>
          <img src="../dist/img/credit/visa.png" alt="Visa">
          <img src="../dist/img/credit/mastercard.png" alt="Mastercard">
          <img src="../dist/img/credit/american-express.png" alt="American Express">
          <img src="../dist/img/credit/paypal2.png" alt="Paypal">

          <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
            este texto podria ser utilizado para algun tipo de aclaraciones sobre algun detalle como derechos etc
          </p>
        </div>

        <div class="col-6">
          <div class="table-responsive">
            <table class="table">
              <tr>

                <th style="width:50%">SUBTOTAL ASEGURADORA:</th>
                <td> <span id="total3"> </span></td>
              </tr>
              <tr>
                <th>DESCUENTO 20%:</th>
                <td>-</td>
              </tr>
              <tr>
                <th> OTROS DESCUENTOS:</th>
                <td>L -</td>
              </tr>
              <tr>
                <th>TOTAL :</th>
                <td> <span id="total4"> </td>
              </tr>
              <tr>
                <th>COPAGO 20%: <input type="checkbox" id="copago" name="my-checkbox" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO" class="alert-status"></th>
                <td> <span class="badge text-md badge-warning" id="valor"> </td>
              </tr>
            </table>
          </div>
        </div>

      </div>

      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
  <!-- Page specific script -->

  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- <script src="../dist/js/demo.js"></script> -->

  <script>
    function Notify(title, text, icon, confirmButtonText, iconColor, animation, toast) {
      Swal.fire({
        title: title,
        text: text,
        icon: icon,
        iconColor: iconColor,
        toast: toast,
      });
    }
  </script>
  <?php include_once 'o-06-script.php';  ?>
  <script>
    //window.addEventListener("load", window.print());
  </script>
</body>

</html>