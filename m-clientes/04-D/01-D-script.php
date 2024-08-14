<script>
    function deleteR(id) {
        //alert(id);
        $('#modal-delete').modal('show');
        readOneRow(id);
    }

    function deleteL() {
        var id = $('#delete_id').val();
        try {
            $.ajax({
                url: "04-D/02-D-controller.php",
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
</script>

<?php 
include_once '../0-includes/6-html-end.php';
?>