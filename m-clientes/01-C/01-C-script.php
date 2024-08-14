<script>
    var table = '<?php echo $table; ?>';

    function create() {
        var description = $('#description').val();
        var seguro = $('#seguro').val();
        var poliza = $('#poliza').val();
        var rtn = $('#rtn').val();
        var certificado = $('#certificado').val();
        var docId = $('#identidad').val();
        try {
            $.ajax({
                url: "01-C/02-C-controller.php",
                type: "POST",
                data: {
                    table: table,
                    description: description,
                    seguro: seguro,
                    poliza: poliza,
                    rtn: rtn,
                    certificado: certificado,
                    docId: docId
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    console.log(dataResult);
                    if (dataResult.statusCode == 200) {
                        $('#modal-create').modal('toggle');
                        console.log(dataResult);
                        if (dataResult.estado) {
                            Notify('Confirmación', dataResult.mensaje, 'success', 'fa fa-check-square', 'fade', 'normal');
                            $('#description').val("");
                            $('#seguro').val("");
                            $('#poliza').val("");
                            $('#rtn').val("");
                            $('#certificado').val("");
                            $('#identidad').val("");
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