<!-- DataTables  & Plugins -->

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
  function updateR(id) {
    //alert(id);
    $('#modal-update').modal('show'); 
    getRow(id); 
  }

  function deleteR(id) {
    //alert(id);
    $('#modal-delete').modal('show');    
    getRow(id);
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
        "url": "controller/read.php",
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
      "columns": [
        // {
        //   defaultContent: '',
        //   "data": "id"
        // },
        {
          defaultContent: '',
          "data": "description"
        },
        {
          defaultContent: '',
          "data": "quantity"
        },
        {
          defaultContent: '',
          "data": "price"
        },
        // {
        //   defaultContent: '',
        //   "data": "status"
        // },
        // {
        //   defaultContent: '',
        //   "data": "created"
        // },
        {
          defaultContent: '',
          "data": "options"
        }
      ]
    });
  }


  


  function getRow(id) {
    var table = '<?php echo $table; ?>';
    //alert('id: '+id+' table: '+ table);
    $.ajax({
      type: 'GET',
      url: 'controller/readOneRow.php',
      data: {
        id: id,
        table: table
      },
      dataType: 'json',
      success: function(response) {
        console.log('response:'+response);       
        $('#edit_id').val(response.id);
        $('#delete_id').val(response.id);
        $('#edit_description').val(response.description);
        $('#edit_quantity').val(response.quantity);
        $('#edit_price').val(response.price);
      }
    });




  }
</script>