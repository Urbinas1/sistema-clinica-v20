<script>
  var table = '<?php echo $table; ?>';
  
  function ReadDatos() {
    var table = "<?php echo $table; ?>";
    $('#example1').DataTable({
      destroy: true,
      responsive: true,
      error: true,
      "ajax": {
        "url": "02-R/02-R-all-controller.php",
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
          "data": "seguro"
        },
        {
          defaultContent: '',
          "data": "poliza"
        },
        {
          defaultContent: '',
          "data": "rtn"
        },
        {
          defaultContent: '',
          "data": "certificado"
        },
        {
          defaultContent: '',
          "data": "docId"
        },
        // {
        //   defaultContent: '',
        //   "data": "price"
        // },
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
  
</script>
