<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../plugins/select2/js/select2.full.min.js"></script>

<script>
  var table = '<?php echo $table; ?>';

  function create() {
    var description = $('#description').val();
    var poliza = $('#poliza').val();
    var certificado = $('#certificado').val();
    var quantity = $('#quantity').val();

    var username = $('#username').val();
    var password = $('#password').val();
    var photo = $('#photo')[0].files[0];
    var form = new FormData();
    form.append('table', table);
    form.append('description', description);
    form.append('poliza', poliza);
    form.append('certificado', certificado);
    form.append('quantity', quantity);
    form.append('username', username);
    form.append('password', password);
    form.append('photo', photo);

    try {
      $.ajax({
        url: "controller/01-C.php",
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          console.log(dataResult);
          if (dataResult.statusCode == 200) {
            $('#modal-create').modal('toggle');
            console.log(dataResult);
            if (dataResult.estado) {
              Notify('Confirmación', dataResult.mensaje, 'success', 'fa fa-check-square', 'fade', 'normal');
              $('#description').val("");
              $('#poliza').val("");
              $('#certificado').val("");
              ReadDatos();
            } else {
              Notify('Error', dataResult.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
              // if (!result.sesion) {
              //   setTimeout(function() {
              //     url = "../index.php";
              //     window.location.href = url;
              //   }, 2000); //1 segundos
              // }
            }
          } else if (dataResult.statusCode == 201) {
            alert("Error occured !");
          }
        }
      });
    } catch (e) {
      Notify('Error', "Ocurrió un error al guardar --- " + e, 'error', 'fa fa-warning', 'fade', 'normal');
    }
  }


  function updateR(id) {
    $('#modal-update').modal('show');
    readOneRow(id);
  }

  function readOneRow(id) {
    $.ajax({
      type: 'GET',
      url: 'controller/readOneRow.php',
      data: {
        id: id,
        table: table
      },
      dataType: 'json',
      success: function(response) {
        console.log('response:' + response);
        $('#edit_<?php echo $field0; ?>').val(response.<?php echo $field0; ?>);
        $('#delete_<?php echo $field0; ?>').val(response.<?php echo $field0; ?>);
        $('#edit_<?php echo $field1; ?>').val(response.<?php echo $field1; ?>);
        $('#edit_<?php echo $field2; ?>').val(response.<?php echo $field2; ?>);
        $('#edit_<?php echo $field3; ?>').val(response.<?php echo $field3; ?>);

        $('#edit_<?php echo $field6; ?>').select2("val", response.<?php echo $field6; ?>);


      }
    });
  }

  function update() {
    var id = $('#edit_id').val();
    var description = $('#edit_description').val();
    var poliza = $('#edit_poliza').val();
    var certificado = $('#edit_certificado').val();
    var quantity = $('#edit_quantity').val();
    try {
      $.ajax({
        url: "controller/03-U.php",
        type: "POST",
        data: {
          id: id,
          table: table,
          description: description,
          poliza: poliza,
          quantity: quantity,
          certificado: certificado
        },
        cache: false,
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          console.log(dataResult);
          if (dataResult.statusCode == 200) {
            $('#modal-update').modal('toggle');
            console.log(dataResult);
            if (dataResult.estado) {
              Notify('Confirmación', dataResult.mensaje, 'success', 'fa fa-check-square', 'fade', 'normal');
              ReadDatos();
            } else {
              Notify('Error', dataResult.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
              // if (!result.sesion) {
              //   setTimeout(function() {
              //     url = "../index.php";
              //     window.location.href = url;
              //   }, 2000); //1 segundos
              // }
            }
          } else if (dataResult.statusCode == 201) {
            alert("Error occured !");
          }
        }
      });
    } catch (e) {
      Notify('Error', "Ocurrió un error al guardar --- " + e, 'error', 'fa fa-warning', 'fade', 'normal');
    }
  }


  function updatePhoto(id) {    
    $('#edit_photo_id').val(id);    
    $('#modal-edit-picture').modal('show');    
  }

  // EDITAR-contrase;a
  function updatePassword(id){    
    $('#modal-new-pass').modal('show');      
    $('#edit_pass_id').val(id);
  }

  function updateP() {
    var photo = $('#edit_photo')[0].files[0];
    var form = new FormData();
    var id = $('#edit_photo_id').val();
    form.append('id', id);
    form.append('table', table);
    form.append('photo', photo);

    try {
      $.ajax({
        url: "controller/03-UP.php",
        data: form,
        cache: false,
        contentType: false,
        processData: false,
        type: "POST",
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          console.log(dataResult);
          if (dataResult.statusCode == 200) {
            $('#modal-edit-picture').modal('toggle');
            console.log(dataResult);

            if (dataResult.estado) {
              Notify('Confirmación', dataResult.mensaje, 'success', 'fa fa-check-square', 'fade', 'normal');
              $('#edit_photo').val("");
              ReadDatos();
            } else {
              Notify('Error', dataResult.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
              // if (!result.sesion) {
              //   setTimeout(function() {
              //     url = "../index.php";
              //     window.location.href = url;
              //   }, 2000); //1 segundos
              // }
            }
          } else if (dataResult.statusCode == 201) {
            alert("Error occured !");
          }
        }
      });
    } catch (e) {
      Notify('Error', "Ocurrió un error al guardar --- " + e, 'error', 'fa fa-warning', 'fade', 'normal');
    }
  }





  function deleteR(id) {
    //alert(id);
    $('#modal-delete').modal('show');
    readOneRow(id);
  }

  function deleteL() {
    var id = $('#delete_id').val();
    try {
      $.ajax({
        url: "controller/04-D.php",
        type: "POST",
        data: {
          id: id,
          table: table
        },
        cache: false,
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          console.log(dataResult);
          if (dataResult.statusCode == 200) {
            $('#modal-delete').modal('toggle');
            console.log(dataResult);
            if (dataResult.estado) {
              Notify('Confirmación', dataResult.mensaje, 'success', 'fa fa-check-square', 'fade', 'normal');
              ReadDatos();
            } else {
              Notify('Error', dataResult.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
              // if (!result.sesion) {
              //   setTimeout(function() {
              //     url = "../index.php";
              //     window.location.href = url;
              //   }, 2000); //1 segundos
              // }
            }
          } else if (dataResult.statusCode == 201) {
            alert("Error occured !");
          }
        }
      });
    } catch (e) {
      Notify('Error', "Ocurrió un error al guardar --- " + e, 'error', 'fa fa-warning', 'fade', 'normal');
    }
  }



  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })

  $(document).ready(function() {
    ReadDatos();
  })

  //READ
  function ReadDatos() {
    var table = "<?php echo $table; ?>";
    $('#example1').DataTable({
      destroy: true,
      responsive: true,
      error: true,
      "ajax": {
        "url": "controller/02-R.php",
        "type": "GET",
        "datatype": "json",
        "data": {
          table: table
        },
        "dataSrc": function(data) {
          if (data.data == null) {
            return [];
          } else {
            return data.data;
          }
        }
      },
      "columns": [{
          defaultContent: '',
          "data": "foto"
        },
        {
          defaultContent: '',
          "data": "description"
        },
        {
          defaultContent: '',
          "data": "poliza"
        },
        {
          defaultContent: '',
          "data": "certificado"
        },
        // {
        //   defaultContent: '',
        //   "data": "quantity"
        // },
        // {
        //   defaultContent: '',
        //   "data": "price"
        // },
        // {
        //   defaultContent: '',
        //   "data": "status"
        // },
        {
          defaultContent: '',
          "data": "type"
        },
        {
          defaultContent: '',
          "data": "options"
        }
      ]
    });
  }
</script>