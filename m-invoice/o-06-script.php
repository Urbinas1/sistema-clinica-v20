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
<script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>


<script>
    $(document).ready(function() {
        //ultimaFacturaActiva(1);
        CargarAtencion();
        //CargarMedicinas();
        //CargarClientes();
        //CargarDoctores();
        //CargarDoctores1();

        ReadDatos();
        ReadDatos1();
        //set datos
        readOneRow();




    });





    $(function() {

        $('.select2').select2()

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', 0);
        })

        $('.alert-status').bootstrapSwitch('state', false);
        document.getElementById("valor").innerHTML = '0.00';

        $('#copago').on('switchChange.bootstrapSwitch', function(event, state) {
            if ($("#copago").is(':checked')) {
                console.log('copago checked');
                var totalx = document.getElementById("total3").innerText;
                //console.log('totalx 1: ' + totalx);
                document.getElementById("valor").innerHTML = totalx * 0.20;
                updateCopago(1);
            } else {
                console.log('no...copago No-Checked-RT');
                var totalx = document.getElementById("total3").innerText;
                //console.log('totalx 2: ' + totalx);
                document.getElementById("valor").innerHTML = (totalx * 0.0);
                updateCopago(0);
            }
        });

        // $('#selectClientes').on('change', function() {

        //     updateIdClient();
        // });



    });


    function copago() {
        if ($("#copago").is(':checked')) {
            console.log('copago checked');
            var totalx = document.getElementById("total3").innerText;
            //console.log('totalx 1: ' + totalx);
            document.getElementById("valor").innerHTML = (totalx * 0.20).toFixed(2);

        } else {
            console.log('no...copago NO-checked');
            var totalx = document.getElementById("total3").innerText;
            //console.log('totalx 2: ' + totalx);
            document.getElementById("valor").innerHTML = (totalx * 0.0);

        }
    }

    function guardarFactura() {
        NotifyQ();
    }


    function imprimir() {
        var id = $('#ultimaFactura').val();
        window.open('invoice-print.php?id=' + id, '_blank');
    }

    function NotifyQ() {
        Swal.fire({
            title: 'Esta seguro de guardar su Factura?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Si',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                //Swal.fire('Guardado!', '', 'success')


                updateStatusFactura();

            } else if (result.isDenied) {
                Swal.fire('La factura no ha sido guardada', '', 'info')

            }
        });
    }



    function addAtt() {
        var item = $('#selectAtencion').val();
        addItemAtt(item);
    }

    function plusMed(id, cant) {
        //alert('funcion plus, id: ' + id + ' cant: ' + cant);
        incrementUnits(id, cant);
    }

    function minusMed(id, cant) {
        //alert('funcion Minus, id: ' + id + ' cant: ' + cant);
        decrementUnits(id, cant);
    }

    function deleteMed(id) {
        //alert('funcion Minus, id: ' + id + ' cant: ' + cant);
        removeUnits(id);
    }



    function removeUnits(id) {
        var table = '<?php echo $table1; ?>';
        try {
            $.ajax({
                url: "controller/04-DitemMed.php",
                type: "POST",
                data: {
                    table: table,
                    id: id
                },
                cache: false,
                success: function(result) {
                    $('#cantidad').val("1");
                    ReadDatos1();
                }
            });
        } catch (error) {

        }
    }


    function addMed() {
        var item = $('#selectMedicinas').val();
        var cant = $('#cantidad').val();
        var id = $('#ultimaFactura').val();
        var table = '<?php echo $table1; ?>';
        try {
            $.ajax({
                url: "controller/01-CitemMed.php",
                type: "POST",
                data: {
                    table: table,
                    idFact: id,
                    idAtt: item,
                    quantity: cant
                },
                cache: false,
                success: function(result) {
                    $('#modal-add-medicinas').modal('toggle');
                    $('#cantidad').val("1");
                    $('#selectMedicinas').select2("val", "0");
                    ReadDatos1();
                }
            });
        } catch (error) {

        }
    }

    function deleteAtt(id) {
        var table = '<?php echo $table1; ?>';
        try {
            $.ajax({
                url: "controller/04-DitemAtt.php",
                type: "POST",
                data: {
                    table: table,
                    id: id
                },
                cache: false,
                success: function(result) {
                    ReadDatos();
                    totales2();
                    copago();
                }
            });
        } catch (error) {

        }
    }

    function addItemAtt(item) {
        var id = $('#ultimaFactura').val();
        var table = '<?php echo $table1; ?>';
        try {
            $.ajax({
                url: "controller/01-CitemAtt.php",
                type: "POST",
                data: {
                    table: table,
                    idFact: id,
                    idAtt: item
                },
                cache: false,
                success: function(result) {
                    $('#modal-add-atencion').modal('toggle');
                    ReadDatos();
                    totales2();
                    copago();
                }
            });
        } catch (error) {

        }

    }





    // function setData(){

    // }



    function readOneRow() {
        console.log('ingresando a la funcion readOneRow');
        var table = '<?php echo $table; ?>';
        $.ajax({
            type: 'GET',
            url: 'controller/readOneRow.php',
            data: {
                table: table
            },
            dataType: 'json',
            success: function(response) {
                //console.log('clienteId: ' + response.clienteId);
                //console.log('doctor1id: ' + response.doctor1id);
                //console.log('doctor2id: ' + response.doctor2id);
                //console.log('tipoFactura: ' + response.tipoFactura);

                // $('#selectClientes').select2("val", response.clienteId);
                // $('#selectDoctores').select2("val", response.doctor1id);
                // $('#selectDoctores1').select2("val", response.doctor2id); //PROBLEMA                
                // $('#selectOption').select2("val", response.tipoFactura);

                showData(response.clienteId);
                showDataD1(response.doctor1id);
                showDataD2(response.doctor2id);
                showDataO();






            }
        });

    }






    function ultimaFacturaActiva(description) {
        var table = '<?php echo $table; ?>';

        $.ajax({
            type: 'GET',
            url: 'controller/readOneRow1.php',
            data: {
                //id: id,
                description: description,
                table: table
            },
            dataType: 'json',
            success: function(response) {
                ultimaFactura = response.id;
                document.getElementById("ultimaFact").innerHTML = '# 00000' + response.id;
                $("#ultimaFactura").val(response.id);
            }
        });
    }





    function CargarAtencion() {
        var table = 'categorias';
        $.ajax({
            url: "./controller/selectAtencion.php",
            type: "GET",
            datatype: "json",
            data: {
                table: table
            },
            success: function(data) {
                let obj = JSON.parse(data);
                var opt = new Option('Seleccione una Atencion', '');
                $('#selectAtencion').append(opt);
                for (var i = 0; i < obj.data.length; i++) {
                    var opt = new Option(obj.data[i].description, obj.data[i].id);
                    $('#selectAtencion').append(opt);
                }
            }
        });
    }

    function CargarMedicinas() {
        var table = 'medicinas';
        $.ajax({
            url: "./controller/selectMedicinas.php",
            type: "GET",
            datatype: "json",
            data: {
                table: table
            },
            success: function(data) {
                let obj = JSON.parse(data);
                var opt = new Option('Seleccione una Medicina', '');
                $('#selectMedicinas').append(opt);
                for (var i = 0; i < obj.data.length; i++) {
                    var opt = new Option(obj.data[i].description, obj.data[i].id);
                    $('#selectMedicinas').append(opt);
                }
            }
        });
    }


    function CargarClientes() {
        var table = 'usuarios';
        $.ajax({
            url: "./controller/selectClientes.php",
            type: "GET",
            datatype: "json",
            data: {
                table: table
            },
            success: function(data) {
                let obj = JSON.parse(data);
                var opt = new Option('Seleccione un Cliente', '');
                $('#selectClientes').append(opt);
                for (var i = 0; i < obj.data.length; i++) {
                    var opt = new Option(obj.data[i].description, obj.data[i].id);
                    $('#selectClientes').append(opt);
                }
            }
        });
    }





    function CargarDoctores() {
        var table = 'usuarios';
        $.ajax({
            url: "./controller/selectDoctores.php",
            type: "GET",
            datatype: "json",
            data: {
                table: table
            },
            success: function(data) {
                let obj = JSON.parse(data);
                var opt = new Option('Seleccione un Doctor', 0);
                $('#selectDoctores').append(opt);
                for (var i = 0; i < obj.data.length; i++) {
                    var opt = new Option(obj.data[i].description, obj.data[i].id);
                    $('#selectDoctores').append(opt);
                }
            }
        });
    }



    function CargarDoctores1() {
        var table = 'usuarios';
        $.ajax({
            url: "./controller/selectDoctores.php",
            type: "GET",
            datatype: "json",
            data: {
                table: table
            },
            success: function(data) {
                let obj = JSON.parse(data);
                var opt = new Option('Seleccione un Doctor', 0);
                $('#selectDoctores1').append(opt);
                for (var i = 0; i < obj.data.length; i++) {
                    console.log(obj.data[i]);
                    var opt = new Option(obj.data[i].description, obj.data[i].id);
                    $('#selectDoctores1').append(opt);
                }
            }
        });
    }



    function incrementUnits(id, cant) {
        var table = '<?php echo $table1; ?>';
        try {
            $.ajax({
                url: "./controller/03-Uup.php",
                type: "POST",
                datatype: "json",
                data: {
                    table: table,
                    id: id,
                    quantity: cant
                },
                success: function(result) {
                    ReadDatos1();

                }
            });
        } catch (error) {

        }
    }


    function decrementUnits(id, cant) {
        var table = '<?php echo $table1; ?>';
        try {
            $.ajax({
                url: "./controller/03-Udown.php",
                type: "POST",
                datatype: "json",
                data: {
                    table: table,
                    id: id,
                    quantity: cant
                },
                success: function(result) {
                    ReadDatos1();

                }
            });
        } catch (error) {

        }
    }




    //READ
    function ReadDatos() {
        var table = "<?php echo $table1; ?>";
        $('#example1').DataTable({
            searching: false,
            info: false,
            paging: false,
            destroy: true,
            responsive: true,
            error: true,
            "ajax": {
                "url": "./controller/02-RDAtt.php",
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
                    "data": "atencion"
                },
                {
                    defaultContent: '',
                    "data": "total"
                },
                {
                    defaultContent: '',
                    "data": "cubreP"
                },
                {
                    defaultContent: '',
                    "data": "cubreA"
                }
            ]
        });
        totales();
        totales2();
        copago();
    }

    function ReadDatos1() {
        var table = "<?php echo $table1; ?>";
        $('#example2').DataTable({
            searching: false,
            info: false,
            paging: false,
            destroy: true,
            responsive: true,
            error: true,
            "ajax": {
                "url": "./controller/02-RDMed.php",
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
                    "data": "atencion"
                },
                {
                    defaultContent: '',
                    "data": "quantity"
                },
                {
                    defaultContent: '',
                    "data": "cubreA"
                },
                {
                    defaultContent: '',
                    "data": "cubreP"
                },
                {
                    defaultContent: '',
                    "data": "cubreA"
                }

            ]
        });
        totales1();
        totales2();
        copago();
    }








    function updateIdClient() {
        var table = '<?php echo $table; ?>';
        var id = $('#ultimaFactura').val();
        var clienteId = $('#selectClientes').val();
        try {
            $.ajax({
                url: "./controller/03-U-.php",
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    clienteId: clienteId
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    console.log(dataResult);
                    if (dataResult.statusCode == 200) {
                        console.log(dataResult);
                        if (dataResult.estado) {
                            $('#modal-add-cliente').modal('toggle');

                            console.log('clientes id: ' + clienteId);
                            showData(clienteId);
                        } else {
                            Notify('Error', dataResult.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
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

    function updateCopago(status) {
        var table = '<?php echo $table ?>';
        var id = $('#ultimaFactura').val();
        try {
            $.ajax({
                url: "./controller/03-U-copago.php",
                type: "POST",
                data: {
                    table: table,
                    id: id,
                    status: status,
                },
                success: function() {
                    console.log('update ok');
                }
            });
        } catch (error) {
            Notify('Error', "Ocurrió un error al guardar --- " + e, 'error', 'fa fa-warning', 'fade', 'normal');
        }
    }

    function updateStatusFactura() {
        var table = '<?php echo $table; ?>';
        var idFactura = $('#ultimaFactura').val();
        try {
            $.ajax({
                url: "./controller/03-U-factura.php",
                type: "POST",
                data: {
                    table: table,
                    id: idFactura,
                },
                success: function() {
                    console.log('update ok');
                    Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
                    location.reload();

                }
            });
        } catch (e) {
            Notify('Error', "Ocurrió un error al guardar --- " + e, 'error', 'fa fa-warning', 'fade', 'normal');
        }
    }


    function showData(clienteId) {
        if (clienteId == 0) {
            document.getElementById("identidad").innerHTML = '';
            document.getElementById("aseguradora").innerHTML = '';
            document.getElementById("rtn").innerHTML = '';
        } else {
            var table = 'usuarios';
            $.ajax({
                type: 'GET',
                url: 'controller/readOneRowU.php',
                data: {
                    id: clienteId,
                    table: table
                },
                dataType: 'json',
                success: function(response) {
                    console.log('response:' + response);
                    $('#nombreCliente').val(response.description);
                    document.getElementById("identidad").innerHTML = '' + response.docId;
                    document.getElementById("aseguradora").innerHTML = '' + response.poliza;
                    document.getElementById("rtn").innerHTML = '' + response.rtn;
                }
            });
        }

    }

    function showDataD1(doctorId) {
        if (doctorId == 0) {
            //document.getElementById("identidad").innerHTML = '';
            $('#nombreDoctor1').val("");

        } else {
            var table = 'usuarios';
            $.ajax({
                type: 'GET',
                url: 'controller/readOneRowD.php',
                data: {
                    id: doctorId,
                    table: table
                },
                dataType: 'json',
                success: function(response) {
                    console.log('response:' + response);
                    $('#nombreDoctor1').val(response.description);

                }
            });
        }

    }

    function showDataD2(doctorId) {
        if (doctorId == 0) {
            // document.getElementById("identidad").innerHTML = '';
            // document.getElementById("aseguradora").innerHTML = '';
            $('#nombreDoctor2').val("");

        } else {
            var table = 'usuarios';
            $.ajax({
                type: 'GET',
                url: 'controller/readOneRowD.php',
                data: {
                    id: doctorId,
                    table: table
                },
                dataType: 'json',
                success: function(response) {
                    console.log('response:' + response);
                    $('#nombreDoctor2').val(response.description);

                }
            });
        }

    }

    function showDataO() {
        var fac = $('#ultimaFactura').val();

        if (fac == "0") {
            // document.getElementById("identidad").innerHTML = '';
            // document.getElementById("aseguradora").innerHTML = '';
            $('#nombreOpcion').val("");

        } else {
            var table = '<?php echo $table; ?>';
            $.ajax({
                type: 'GET',
                url: 'controller/readOneRowO.php',
                data: {
                    id: fac,
                    table: table
                },
                dataType: 'json',
                success: function(response) {
                    console.log('respuesta al obtener el tipo de factura ......... 123 xxxxxx  ... :' + response);

                    if (response.tipoFactura == 1) {
                        $('#nombreOpcion').val("CREDITO");
                    }
                    if (response.tipoFactura == 2) {
                        $('#nombreOpcion').val("CONTADO");
                    }

                    if (response.copago == 1) {
                        $('.alert-status').bootstrapSwitch('state', true);
                        copago();
                    }
                    if (response.copago == 0) {
                        $('.alert-status').bootstrapSwitch('state', false);
                        copago();
                    }

                    window.print()
                }
            });
        }

    }


    function totales() {
        var table = '<?php echo $table1; ?>';
        var id = $('#ultimaFactura').val();
        //console.log('table: ' + table + ' id: ' + id);
        $.ajax({
            type: 'GET',
            url: 'controller/readOneRow2.php',
            data: {
                //id: id,
                id: id,
                table: table
            },
            dataType: 'json',
            success: function(response) {
                document.getElementById("total1").innerHTML = 'SUB TOTAL:L ' + response.total1;
            }
        });
        totales2();
        copago();
    }

    function totales1() {
        var table = '<?php echo $table1; ?>';
        var id = $('#ultimaFactura').val();
        //console.log('table: ' + table + ' id: ' + id);
        $.ajax({
            type: 'GET',
            url: 'controller/readOneRow3.php',
            data: {
                //id: id,
                id: id,
                table: table
            },
            dataType: 'json',
            success: function(response) {
                document.getElementById("total2").innerHTML = 'SUB TOTAL:L ' + response.total1;
            }
        });
        totales2();
        copago();

    }

    function totales2() {
        var table = '<?php echo $table1; ?>';
        var id = $('#ultimaFactura').val();
        //console.log('table: ' + table + ' id: ' + id);
        $.ajax({
            type: 'GET',
            url: 'controller/readOneRow4.php',
            data: {
                //id: id,
                id: id,
                table: table
            },
            dataType: 'json',
            success: function(response) {

                console.log('respuesta totalR total3 ' + response.totalR)


                if (response.totalR === null) {
                    document.getElementById("total3").innerHTML = 0;
                    document.getElementById("total4").innerHTML = 0;
                    console.log('respuesta total3 ' + 0)


                    //guardarImprimir.style.display = "none";
                    //resumen.style.display = "none";


                } else {
                    //console.log('respuesta total3 ' + response.totalR)
                    //document.getElementById("total3").innerHTML = response.totalR;
                    //document.getElementById("total4").innerHTML = response.totalR;

                    // if (response.totalR == 0) {
                    //     resumen.style.display = "none";
                    //     guardarImprimir.style.display = "none";
                    // }

                    // if (response.totalR > 0) {
                    //     resumen.style.display = "flex";
                    //     guardarImprimir.style.display = "inline";

                    // }

                }
                copago();
            }
        });
    }



    function updateDoctor1Id() {
        var table = '<?php echo $table; ?>';
        var id = $('#ultimaFactura').val();
        var doctor1id = $('#selectDoctores').val();
        try {
            $.ajax({
                url: "controller/03-U1.php",
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    doctor1id: doctor1id
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    console.log(dataResult);
                    if (dataResult.statusCode == 200) {
                        console.log(dataResult);
                        if (dataResult.estado) {
                            $('#modal-add-doctor1').modal('toggle');
                            showDataD1(doctor1id);
                            //$('#nombreDoctor1').val(response.description);
                        } else {
                            Notify('Error', dataResult.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
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


    function updateDoctor2Id() {
        var table = '<?php echo $table; ?>';
        var id = $('#ultimaFactura').val();
        var doctor2id = $('#selectDoctores1').val();
        try {
            $.ajax({
                url: "controller/03-U2.php",
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    doctor2id: doctor2id
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    console.log(dataResult);
                    if (dataResult.statusCode == 200) {
                        console.log(dataResult);
                        if (dataResult.estado) {
                            $('#modal-add-doctor2').modal('toggle');
                            showDataD2(doctor2id);
                            $('#nombreDoctor2').val(dataResult.description);
                        } else {
                            Notify('Error', dataResult.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
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

    function tipoFactura() {
        var table = '<?php echo $table; ?>';
        var id = $('#ultimaFactura').val();
        var tipoFactura = $('#selectOption').val();
        try {
            $.ajax({
                url: "controller/03-Uf.php",
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    tipoFactura: tipoFactura
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    console.log(dataResult);
                    if (dataResult.statusCode == 200) {
                        if (dataResult.estado) {
                            $('#modal-add-opcion').modal('toggle');
                            showDataO();
                        } else {
                            Notify('Error', dataResult.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
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