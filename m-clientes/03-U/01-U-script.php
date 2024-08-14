<script>
  var table = '<?php echo $table; ?>';

  function updateR(id) {
    $('#modal-update').modal('show');
    readOneRow(id);
  }
  
  function update() {
    var id = $('#edit_id').val();
    var description = $('#edit_description').val();
    var seguro = $('#edit_seguro').val();
    var poliza = $('#edit_poliza').val();
    var rtn = $('#edit_rtn').val();
    var certificado = $('#edit_certificado').val();
    var docId = $('#edit_identidad').val();
    try {
      $.ajax({
        url: "03-U/02-U-controller.php",
        type: "POST",
        data: {
          id: id,
          table: table,
          description: description,
          seguro: seguro,
          poliza: poliza,
          rtn: rtn,
          certificado: certificado,
          docId : docId
        },
        cache: false,
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          console.log(dataResult);
          if (dataResult.statusCode == 200) {
            $('#modal-update').modal('toggle');            
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
  
</script>
