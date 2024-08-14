<script>
  var table = '<?php echo $table; ?>';
  
  function readOneRow(id) {
    $.ajax({
      type: 'GET',
      url: '02-R/02-R-one-controller.php',
      data: {
        id: id,
        table: table
      },
      dataType: 'json',
      success: function(response) {
        console.log('response:' + response);
        $('#edit_id').val(response.id);
        $('#delete_id').val(response.id);
        $('#edit_description').val(response.description);
        $('#edit_seguro').val(response.seguro);
        $('#edit_price').val(response.price);
        $('#edit_quantity').val(response.quantity);
        $('#edit_poliza').val(response.poliza);
        $('#edit_rtn').val(response.rtn);
        $('#edit_certificado').val(response.certificado);
        $('#edit_identidad').val(response.docId);
      }
    });
  }
  
</script>
