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
                <FONT FACE="Lucida Calligraphy"> <img src="../dist/img/logo.jpg"> Policlinica San Rafael.</FONT>
       
                  <input type="hidden" id="ultimaFactura">
                  <small class="float-right">Fecha: <?php echo $fecha_actual; ?></small>
                </h4>
              </div>

            </div>

            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                <address>
                  <label>Calle Vicente Williams, Salida a Marcovia</label><br>
                  <label>Choluteca,Honduras, C.A.</label><br>
                  <label>Teléfono: +(504) 2782-0261  /  RTN: 17071981004960</label><br>
                </address>


                <button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#modal-add-categorias">
                  <i class="fa fa-plus"></i>
                  AGREGAR CATEGORIA</button>


              </div>

              <div class="col-sm-4 invoice-col">
             
                <address>
                  <br>
                <b>1. Facturacion del Paciente:</b><br>
                <br>
                  <div class="input-group input-group-sm col-sm-7">
                      <input type="text" disabled readonly id="nombreCliente" class="form-control">
                      <span class="input-group-append">
                        <button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#modal-add-cliente"><i class="fa fa-plus"></i> </button>
                      </span>
                  </div>
                
                  <br>
                  <b>Poliza:</b>
                  <span class="badge badge-warning text-md" id="poliza">0000-0000-0000</span>
                  <br><br>
                  <b>Aseguradora:</b>
                  <span class="badge badge-warning text-md" id="seguro">SEGUROS XXXXX </span>
                </address>
              </div>

              <div class="col-sm-4 invoice-col">
                <b>Numero de Factura: <span class="badge text-md badge-warning" id="ultimaFact"> </span> </b><br>
                <br>
                <b>1. Medico Tratante:</b>

                <div class="input-group input-group-sm col-sm-11">

                  <!-- <select class="form-control select2 select2-danger" id="selectDoctores" required data-dropdown-css-class="select2-danger" style="width: 100%;">
                  </select> -->

                  <input type="text" disabled readonly id="nombreDoctor1" class="form-control">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#modal-add-doctor1"><i class="fa fa-plus"></i> </button>
                  </span>

                </div>

                <b>2. Medico Tratante: </b>

                <div class="input-group input-group-sm col-sm-11">
                  <input type="text" disabled readonly id="nombreDoctor2" class="form-control">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#modal-add-doctor2"><i class="fa fa-plus"></i> </button>
                  </span>
                </div>


                <b>TIPO FACTURACION</b><br>
                <div class="input-group input-group-sm col-sm-11">
                  <input type="text" disabled readonly id="nombreOpcion" class="form-control">
                  <span class="input-group-append">
                    <button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#modal-add-opcion"><i class="fa fa-plus"></i> </button>
                  </span>
                </div>
              </div>
            </div>

            <div class="row" id="cate1" style="display: none;">
              <h5 style="color: blue">
              <button style="margin:5px 24px " type="button" class="btn btn-danger btn-sm" onclick="quitarCategoria(1)">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Eliminar Categoria</button>
                <strong><b>ATENCIÓN EN LA EMERGENCIA </b></strong>
                <button style="margin:5px 24px " type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-atencion">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Agrega Categoria</button>
              </h5>

              <div class="col-12 table-responsive">
                <br>
                <table class="table table-striped" id="example1" style="display: none; width: 100%;">
                  <thead>
                    <tr>
                      <th>  <img src="../dist/img/icons8-health-book-64.png" alt="">DESCRIPCIÓN </th> 
                      <th> <img src="../dist/img/icons8-cuenta-64.png"  alt="">TOTAL </th> 
                      <th> <img src="../dist/img/icons8-efectivo-64.png"  alt="">CUBRE PACIENTE </th> 
                      <th> <img src="../dist/img/icons8-escudo-de-seguridad-de-la-ventana-del-hombre-64.png"  alt="">CUBRE ASEGURADORA </th>
                      <th> <img src="../dist/img/icons8-eliminar.gif"  alt="">ELIMINAR ATENCION </th>
                    </tr>
                  </thead>

                </table>
                <h4 style="color: orange; text-align: right;">
                  <strong>
                    <b>
                      <span class="badge badge-warning " id="total1" style="display: none;">
                        SUB TOTAL:L ----.00
                      </span>
                    </b>
                  </strong>
                </h4>
                <hr>
              </div>
            </div>

            <br>


            <div class="row" id="cate5" style="display: none;">
              <h5 style="color: blue">
                <button style="margin:5px 24px " type="button" class="btn btn-danger btn-sm" onclick="quitarCategoria(5)">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Eliminar Categoria</button>
                <strong><b>HOSPITALIZACION </b></strong>
                <button style="margin:5px 24px " type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-hospitalizacion">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Agrega Categoria</button>
              </h5>

              <div class="col-12 table-responsive">
                <br>
                <table class="table table-striped" id="example5" style="display: none; width: 100%;">
                  <thead>
                    <tr>
                    <th> <img src="../dist/img/icons8-hospital-64 (1)1q.png"  alt="">DESCRIPCIÓN </th> 
                      <th> <img src="../dist/img/icons8-cuenta-64.png"  alt="">TOTAL </th> 
                      <th> <img src="../dist/img/icons8-efectivo-64.png"  alt="">CUBRE PACIENTE </th> 
                      <th> <img src="../dist/img/icons8-escudo-de-seguridad-de-la-ventana-del-hombre-64.png"  alt="">CUBRE HOSPITALIZACION </th>
                      <th> <img src="../dist/img/icons8-eliminar.gif"  alt="">ELIMINAR ATENCION </th>
                    </tr>
                  </thead>

                </table>
                <h4 style="color: orange; text-align: right;">
                  <strong>
                    <b>
                      <span class="badge badge-warning " id="total5" style="display: none;">
                        SUB TOTAL: L ----.00
                      </span>
                    </b>
                  </strong>
                </h4>
                <hr>
              </div>
            </div>

            <br>

            <!--INI 2DA CUERPO Y TABLA DE LA CATEGORIA -->
            <div class="row" id="cate2" style="display: none;">
              <h5 style="color: blue">
                <button  style="margin:5px 24px " type="button" class="btn btn-danger btn-sm" onclick="quitarCategoria(2)">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Eliminar Categoria</button>
                <strong>
                  <b>MEDICINAS Y SUMINISTROS</b>
                </strong>
                <button  style="margin:5px 24px " type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-medicinas">   <i class="fa fa-plus">
                </i>&nbsp;&nbsp;&nbsp;Agrega Categoria</button>

              </h5>
              <div class="col-12 table-responsive">
                <br>
                <table class="table table-striped" id="example2" style="display: none; width: 100%;">
                  <thead>
                    <tr>
                    <th> <img src="../dist/img/icons8-vaccine-64.png"  alt="">DESCRIPCIÓN </th> 
                    <th> <img src="../dist/img/icons8-trolley-64.png" alt="">CANTIDAD </th> 
                      <th> <img src="../dist/img/icons8-cuenta-64.png"  alt="">TOTAL </th> 
                      <th> <img src="../dist/img/icons8-efectivo-64.png"  alt="">CUBRE PACIENTE </th> 
                      <th> <img src="../dist/img/icons8-escudo-de-seguridad-de-la-ventana-del-hombre-64.png"  alt="">CUBRE ASEGURADORA </th>
                      <th><img src="../dist/img/icons8-agregar-carpeta.gif" alt="">AGREGAR  </th>
                      <th><img src="../dist/img/icons8-eliminar-carpeta.gif" alt="">QUITAR  </th>
                      <th> <img src="../dist/img/icons8-eliminar.gif"  alt="">ELIMINAR MEDICINAS Y SUMINISTROS </th>
                    </tr>
                  </thead>
                  
                </table>
                <h4 style="color: orange; text-align: right;"> <strong>
                    <b>
                      <span class="badge badge-warning " id="total2" style="display: none;">
                        SUB TOTAL: L ----.00
                      </span>

                    </b>
                  </strong>
                </h4>
                <hr>

              </div>

            </div>

            <!-- 2DA FIN CUERPO Y TABLA DE LA CATEGORIA -->



            <!--INI 3ERA CAT CUERPO Y TABLA DE LA CATEGORIA -->
            <div class="row" id="cate3" style="display: none;">
              <h5 style="color: blue">

                <button  style="margin:5px 24px " type="button" class="btn btn-danger btn-sm" onclick="quitarCategoria(3)">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Eliminar Categoria</button>
                <strong>
                  <b>SALA CUNA</b>
                </strong>
                <button  style="margin:5px 24px " type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-atCliente">
                </i>&nbsp;&nbsp;&nbsp;Agrega Categoria</button>

              </h5>
              <div class="col-12 table-responsive">
                <br>
                <table class="table table-striped" id="example3" style="display: none; width: 100%;">
                  <thead>
                    <tr>
                      <th>  <img src="../dist/img/icons8-cuarto-de-hospital-64.png" alt="">DESCRIPCIÓN </th> 
                      <th> <img src="../dist/img/icons8-trolley-64.png" alt="">CANTIDAD </th> 
                      <th> <img src="../dist/img/icons8-cuenta-64.png"  alt="">TOTAL </th> 
                      <th> <img src="../dist/img/icons8-efectivo-64.png"  alt="">CUBRE PACIENTE </th> 
                      <th> <img src="../dist/img/icons8-escudo-de-seguridad-de-la-ventana-del-hombre-64.png"  alt="">CUBRE ASEGURADORA </th>
                      <th><img src="../dist/img/icons8-agregar-carpeta.gif" alt="">AGREGAR  </th>
                      <th><img src="../dist/img/icons8-eliminar-carpeta.gif" alt="">QUITAR  </th>
                      <th> <img src="../dist/img/icons8-eliminar.gif"  alt="">ELIMINAR SALA CUNA</th>
                    </tr>
                  </thead>

                </table>
                <h4 style="color: orange; text-align: right;"> <strong>
                    <b>
                      <span class="badge badge-warning " id="total3at" style="display: none;">
                        SUB TOTAL: L ----.00
                      </span>

                    </b>
                  </strong>
                </h4>
                <hr>

              </div>

            </div>
            <!--FIN 3ER CAT CUERPO Y TABLA DE LA CATEGORIA -->




            <!--INI 4ta CUERPO Y TABLA DE LA CATEGORIA -->
            <div class="row" id="cate4" style="display: none;">
              <h5 style="color: blue">

                <button  style="margin:5px 24px "  type="button" class="btn btn-danger btn-sm" onclick="quitarCategoria(4)">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Eliminar Categoria</button>
                <strong>
                  <b>MATERIALES QUIRURGICOS</b>
                </strong>
                <button  style="margin:5px 24px " type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-add-mat"> 
                   <i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Eliminar Categoria</button>
              </h5>
              <div class="col-12 table-responsive">
                <br>
                <table class="table table-striped" id="example4" style="display: none; width: 100%;">
                  <thead>
                    <tr>
                    <th>  <img src="../dist/img/icons8-operating-room-40.png" alt="">DESCRIPCIÓN </th> 
                      <th> <img src="../dist/img/icons8-trolley-64.png" alt="">CANTIDAD </th> 
                      <th> <img src="../dist/img/icons8-cuenta-64.png"  alt="">TOTAL </th> 
                      <th> <img src="../dist/img/icons8-efectivo-64.png"  alt="">CUBRE PACIENTE </th> 
                      <th> <img src="../dist/img/icons8-escudo-de-seguridad-de-la-ventana-del-hombre-64.png"  alt="">CUBRE ASEGURADORA </th>
                      <th><img src="../dist/img/icons8-agregar-carpeta.gif" alt="">AGREGAR  </th>
                      <th><img src="../dist/img/icons8-eliminar-carpeta.gif" alt="">QUITAR  </th>
                      <th> <img src="../dist/img/icons8-eliminar.gif"  alt="">MATERIALES QUIRURGICOS</th>
                    </tr>
                  </thead>

                </table>
                <h4 style="color: orange; text-align: right;"> <strong>
                    <b>
                      <span class="badge badge-warning " id="total4Mat" style="display: none;">
                        SUB TOTAL:L ----.00
                      </span>

                    </b>
                  </strong>
                </h4>
                <hr>

              </div>

            </div>

            <!-- 4ta FIN CUERPO Y TABLA DE LA CATEGORIA -->


            <div class="row" id="resumen" style="display: none;">

              <div class="col-6">
              
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                 
                </p>
              </div>

              <div class="col-6">
                <div class="table-responsive">
                  <table class="table">

                    <tr>
                      <th style="width:50%">SUBTOTAL:</th>
                      <td> <span id="total3"> </span></td>
                    </tr>

                    <tr>
                      <th>DESCUENTO
                        <button type="button" class="btn btn-danger btn-xs" id="btnTasa" onclick="addTasa()">
                          0%
                        </button>
                      </th>
                      <td><span id="descuento0"> L -</td>
                    </tr>
                    <tr>
                      <th>
                        <button type="button" class="btn btn-danger btn-xs" id="" onclick="addOtroDesc()">
                          OTROS DESCUENTOS
                        </button>
                      </th>
                      <td><span id="otherDesc"> L -</td>
                    </tr>
                    <tr>
                      <th>TOTAL :</th>
                      <td> <span id="total4"> </td>
                    </tr>
                   

                    <tr>
                      <!-- NUEVO COPAGO -->
                      <th>COPAGO
                        <button type="button" class="btn btn-info btn-xs" id="btnCP2" onclick="addCopago()">
                          0%
                        </button>
                      </th>
                      <td><span id="valorCP2"> L -</td>
                    </tr>

                    <tr>
                      <th style="width:50%; color:#138496">NO ELEGIBLE:</th>
                      <td> <span id="totalCP"> </span></td>
                    </tr>

                    <tr>
                      <th>
                        <button type="button" class="btn btn-info btn-xs" id="" onclick="addDeducible()">
                          DEDUCIBLE
                        </button>
                      </th>
                      <td><span id="deducible"> L -</td>
                    </tr>

                    <tr>
                      <th style="width:50%; color:blue">TOTAL A PAGAR:</th>
                      <td> <span id="totalTP_"> </span></td>
                    </tr>





                  </table>
                </div>
              </div>

            </div>



            <div class="row no-print" id="guardarImprimir" style="display: none;">
              <div class="col-12">
                <a href="" onclick="imprimir()" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i>
                  IMPRIMIR</a>
                <button type="button" onclick="guardarFactura()" class="btn btn-success float-right"><i class="far fa-credit-card"></i> GUARDAR
                </button>

              </div>
            </div>


          </div>


        </div>
      </div>
    </div>

  </section>

</div>