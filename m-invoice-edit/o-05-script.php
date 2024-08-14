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
    var id_fact = 0;
    id_fact = parseInt('<?php echo $idfact ?>', 10);
    $(document).ready(function() {
        if (isNaN(id_fact)) {
            id_fact = 0;            
            ultimaFacturaActiva(1);
        } else {            
            ultimaFactura = id_fact;
            document.getElementById("ultimaFact").innerHTML = '# 00000' + id_fact;
            $("#ultimaFactura").val(id_fact);
        }

        //AQUI SE ESTAN CARGANDO LOS SELECTORES
        CargarAtencion();
        CargarMedicinas();
        CargarMateriales();
        CargarListaAtCliente();
        CargarHospitalizacion();

        CargarClientes();
        CargarDoctores();
        CargarDoctores1();

        dataOfAte();
        dataOfMed();
        dataOfMat();
        dataOfHospitalizacion();

        dataOfAtCliente();
        reaRowOfCurrentInvoice();//CARGAR LA INFORMACION BASE DE LA FACTURA
        showCategorias();
        totalFactura();

    });




    $(function() {
        $('.select2').select2()
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', 0);
        })
        $('.alert-status').bootstrapSwitch('state', false);
    });





    function guardarFactura() {
        NotifyQ();
    }

    function quitarCategoria(categoria) {
        NotifyQCategoria(categoria);
    }


    function imprimir() {
        var id = $('#ultimaFactura').val();
        window.open('factura.php?idfact=' + id, '_blank');
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
                updateStatusFactura();
            } else if (result.isDenied) {
                Swal.fire('La factura no ha sido guardada', '', 'info')
            }
        });
    }


    function NotifyQCategoria(categoria) {
        Swal.fire({
            title: 'Desea quitar esta categoria? ' + categoria,
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
                updateCategoriaX(categoria);
            } else if (result.isDenied) {
                Swal.fire('sin cambios', '', 'info')
            }
        });
    }



    function addAtt() {
        var item = $('#selectAtencion').val();
        addItemAtt(item);
    }

    function addHospitalizacion() {
        var item = $('#selectHospitalizacion').val();
        addItemHospitalizacion(item);
    }

    function plusMed(id, cant) {
        incrementUnits(id, cant);
    }

    function minusMed(id, cant) {
        decrementUnits(id, cant);
    }

    function deleteMed(id) {
        removeUnits(id);
    }

    function deleteItem(id) {
        removeItem(id);
    }

    //funciones para los botones aumentar cantidad, disminuir cantidad, eliminar fila

    function plusAtCliente(id, cant) {
        incrementUnits(id, cant);
    }

    function minusAtCliente(id, cant) {
        decrementUnits(id, cant);
    }

    function deleteAtCliente(id) {
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
                    dataOfMed();
                    dataOfMat();
                    dataOfAtCliente();
                }
            });
        } catch (error) {

        }
    }

    function removeItem(id) {
        var table = '<?php echo $table1; ?>';
        try {
            $.ajax({
                url: "controller/04-DitemItem.php",
                type: "POST",
                data: {
                    table: table,
                    id: id
                },
                cache: false,
                success: function(result) {
                    $('#cantidad').val("1");
                    dataOfMed();
                    dataOfMat();
                    dataOfAtCliente();
                    dataOfHospitalizacion();
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
                    dataOfMed();
                }
            });
        } catch (error) {

        }
    }


    function addMat() {
        var item = $('#selectMat').val();
        var cant = $('#cantidadMat').val();
        var id = $('#ultimaFactura').val();
        var table = '<?php echo $table1; ?>';
        try {
            $.ajax({
                url: "controller/01-CitemMat.php",
                type: "POST",
                data: {
                    table: table,
                    idFact: id,
                    idAtt: item,
                    quantity: cant
                },
                cache: false,
                success: function(result) {
                    $('#modal-add-mat').modal('toggle');
                    $('#cantidadMat').val("1");
                    $('#selectMat').select2("val", "0");
                    dataOfMat();
                }
            });
        } catch (error) {

        }
    }


    function addatCliente() {
        var item = $('#selectAteCliente').val();
        var cant = $('#cantidadat').val();
        var id = $('#ultimaFactura').val();
        var table = '<?php echo $table1; ?>';
        try {
            $.ajax({
                url: "controller/01-CitemAtCliente.php",
                type: "POST",
                data: {
                    table: table,
                    idFact: id,
                    idAtt: item,
                    quantity: cant
                },
                cache: false,
                success: function(result) {
                    $('#modal-add-atCliente').modal('toggle');
                    $('#cantidadat').val("1");
                    $('#selectAteCliente').select2("val", "0");
                    dataOfAtCliente();
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
                    dataOfAte();
                    totalFactura();
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
                    dataOfAte();
                    totalFactura();
                }
            });
        } catch (error) {

        }

    }


    function addItemHospitalizacion(item) {
        var id = $('#ultimaFactura').val();
        var table = '<?php echo $table1; ?>';
        try {
            $.ajax({
                url: "controller/01-CitemHospitalizacion.php",
                type: "POST",
                data: {
                    table: table,
                    idFact: id,
                    idAtt: item
                },
                cache: false,
                success: function(result) {
                    $('#modal-add-hospitalizacion').modal('toggle');
                    dataOfHospitalizacion();
                    totalFactura();
                }
            });
        } catch (error) {

        }

    }







    function reaRowOfCurrentInvoice() {
        var table = '<?php echo $table; ?>';
        $.ajax({
            type: 'GET',
            url: 'controller/readOneRow.php',
            data: {
                table: table,
                ultimoId: id_fact
            },
            dataType: 'json',
            success: function(response) {
                dataFromClient(response.clienteId);
                showDataD1(response.doctor1id);
                showDataD2(response.doctor2id);
                dataOfInvoice();
            }
        });

    }


    function showCategorias() {
        var table = '<?php echo $table; ?>';
        $.ajax({
            type: 'GET',
            url: 'controller/readOneRow.php',
            data: {
                table: table,
                ultimoId: id_fact
            },
            dataType: 'json',
            success: function(response) {

                var table1 = document.getElementById("example1");
                var span1 = document.getElementById("total1");
                var div1 = document.getElementById("cate1");
                var table2 = document.getElementById("example2");
                var span2 = document.getElementById("total2");
                var div2 = document.getElementById("cate2");
                // referenciamos al div que contiene al nueva categoria
                var table3 = document.getElementById("example3");
                var span3 = document.getElementById("total3at");
                var div3 = document.getElementById("cate3");

                var table4 = document.getElementById("example4");
                var span4 = document.getElementById("total4Mat");
                var div4 = document.getElementById("cate4");

                var table5 = document.getElementById("example5");
                var span5 = document.getElementById("total5");
                var div5 = document.getElementById("cate5");


                //console.log(typeof(response.cat1) + '  el string es: ' + response.cat1);

                if (response.cat1 == "1") {
                    div1.style.display = "block";
                    table1.style.display = "table";
                    span1.style.display = "inline";

                } else {
                    div1.style.display = "none";
                    table1.style.display = "none";
                    span1.style.display = "none";
                }


                if (response.cat2 == "1") {
                    div2.style.display = "block";
                    table2.style.display = "table";
                    span2.style.display = "inline";

                } else {
                    div2.style.display = "none";
                    table2.style.display = "none";
                    span2.style.display = "none";
                }

                if (response.cat3 == "1") {
                    div3.style.display = "block";
                    table3.style.display = "table";
                    span3.style.display = "inline";

                } else {
                    div3.style.display = "none";
                    table3.style.display = "none";
                    span3.style.display = "none";
                }

                if (response.cat4 == "1") {
                    div4.style.display = "block";
                    table4.style.display = "table";
                    span4.style.display = "inline";

                } else {
                    div4.style.display = "none";
                    table4.style.display = "none";
                    span4.style.display = "none";
                }

                if (response.cat5 == "1") {
                    div5.style.display = "block";
                    table5.style.display = "table";
                    span5.style.display = "inline";

                } else {
                    div5.style.display = "none";
                    table5.style.display = "none";
                    span5.style.display = "none";
                }



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


    function CargarHospitalizacion() {
        var table = 'hospitalizacion';
        $.ajax({
            url: "./controller/selectHospitalizacion.php",
            type: "GET",
            datatype: "json",
            data: {
                table: table
            },
            success: function(data) {
                let obj = JSON.parse(data);
                var opt = new Option('Seleccione una Hospitalizacion', '');
                $('#selectHospitalizacion').append(opt);
                for (var i = 0; i < obj.data.length; i++) {
                    var opt = new Option(obj.data[i].description, obj.data[i].id);
                    $('#selectHospitalizacion').append(opt);
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

    function CargarMateriales() {
        var table = 'materiales';
        $.ajax({
            url: "./controller/selectMateriales.php",
            type: "GET",
            datatype: "json",
            data: {
                table: table
            },
            success: function(data) {
                let obj = JSON.parse(data);
                var opt = new Option('Seleccione un Material', '');
                $('#selectMat').append(opt);
                for (var i = 0; i < obj.data.length; i++) {
                    var opt = new Option(obj.data[i].description, obj.data[i].id);
                    $('#selectMat').append(opt);
                }
            }
        });
    }


    function CargarListaAtCliente() {
        var table = 'medicinas';
        $.ajax({
            url: "./controller/selectAteCliente.php",
            type: "GET",
            datatype: "json",
            data: {
                table: table
            },
            success: function(data) {
                let obj = JSON.parse(data);
                var opt = new Option('Seleccione una Atencion', '');
                $('#selectAteCliente').append(opt);
                for (var i = 0; i < obj.data.length; i++) {
                    var opt = new Option(obj.data[i].description, obj.data[i].id);
                    $('#selectAteCliente').append(opt);
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
                    dataOfMed();
                    dataOfMat();
                    dataOfAtCliente();
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
                    dataOfMed();
                    dataOfMat();
                    dataOfAtCliente();

                }
            });
        } catch (error) {

        }
    }




    //READ
    function dataOfAte() {
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
                    table: table,
                    ultimoId: id_fact
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
                },
                {
                    defaultContent: '',
                    "data": "options"
                }
            ]
        });
        totalFactura();

    }


    //READ
    function dataOfHospitalizacion() {
        var table = "<?php echo $table1; ?>";
        $('#example5').DataTable({
            searching: false,
            info: false,
            paging: false,
            destroy: true,
            responsive: true,
            error: true,
            "ajax": {
                "url": "./controller/02-RDHospitalizacion.php",
                "type": "GET",
                "datatype": "json",
                "data": {
                    table: table,
                    ultimoId: id_fact
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
                },
                {
                    defaultContent: '',
                    "data": "options"
                }
            ]
        });
        totalFactura();

    }

    function dataOfMed() {
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
                    table: table,
                    ultimoId: id_fact
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
                    "data": "total"
                },
                {
                    defaultContent: '',
                    "data": "cubreP"
                },
                {
                    defaultContent: '',
                    "data": "cubreA"
                },
                {
                    defaultContent: '',
                    "data": "btnPlus"
                },
                {
                    defaultContent: '',
                    "data": "btnMinus"
                },
                {
                    defaultContent: '',
                    "data": "options"
                }
            ]
        });
        totalFactura();
    }


    function dataOfMat() {
        var table = "<?php echo $table1; ?>";
        $('#example4').DataTable({
            searching: false,
            info: false,
            paging: false,
            destroy: true,
            responsive: true,
            error: true,
            "ajax": {
                "url": "./controller/02-RDMat.php",
                "type": "GET",
                "datatype": "json",
                "data": {
                    table: table,
                    ultimoId :id_fact
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
                    "data": "total"
                },
                {
                    defaultContent: '',
                    "data": "cubreP"
                },
                {
                    defaultContent: '',
                    "data": "cubreA"
                },
                {
                    defaultContent: '',
                    "data": "btnPlus"
                },
                {
                    defaultContent: '',
                    "data": "btnMinus"
                },
                {
                    defaultContent: '',
                    "data": "options"
                }
            ]
        });
        totalFactura();
    }

    // ESTA FUNCION CARGA LA DATA DENTRO DE LA TABLA DE LA 3ERA CATEGORIA

    function dataOfAtCliente() {
        var table = "<?php echo $table1; ?>";
        $('#example3').DataTable({
            searching: false,
            info: false,
            paging: false,
            destroy: true,
            responsive: true,
            error: true,
            ajax: {
                url: "./controller/02-RDAtCliente.php",
                type: "GET",
                datatype: "json",
                data: {
                    table: table,
                    ultimoId: id_fact
                },
                error: function(xhr, error, thrown) {
                    console.error('AJAX error:', error); // Log AJAX errors
                    console.error('Thrown error:', thrown);
                },
                dataSrc: function(json) {
                    if (!json || !json.data) {
                        return [];
                    }
                    return json.data;
                }
            },
            columns: [{
                    defaultContent: '',
                    data: "atencion"
                },
                {
                    defaultContent: '',
                    data: "quantity"
                },
                {
                    defaultContent: '',
                    data: "total"
                },
                {
                    defaultContent: '',
                    data: "cubreP"
                },
                {
                    defaultContent: '',
                    data: "cubreA"
                },
                {
                    defaultContent: '',
                    data: "btnPlus"
                },
                {
                    defaultContent: '',
                    data: "btnMinus"
                },
                {
                    defaultContent: '',
                    data: "options"
                }
            ]
        });

        totalFactura();
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
                    if (dataResult.statusCode == 200) {
                        if (dataResult.estado) {
                            $('#modal-add-cliente').modal('toggle');
                            dataFromClient(clienteId);
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
                success: function() {}
            });
        } catch (error) {
            Notify('Error', "Ocurrió un error al guardar --- " + e, 'error', 'fa fa-warning', 'fade', 'normal');
        }
    }



    function updateCat() {
        var table = '<?php echo $table ?>';
        var id = $('#ultimaFactura').val();
        var idCat = $('#selectCategoria').val();
        try {
            $.ajax({
                url: "./controller/03-U-categoria.php",
                type: "POST",
                data: {
                    table: table,
                    id: id,
                    idCat: idCat,
                },
                success: function() {
                    $('#modal-add-categorias').modal('toggle');
                    showCategorias()

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
                    Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
                    location.reload();

                }
            });
        } catch (e) {
            Notify('Error', "Ocurrió un error al guardar --- " + e, 'error', 'fa fa-warning', 'fade', 'normal');
        }
    }



    function updateCategoriaX(categoria) {
        var table = 'facturas';
        var table1 = 'facturasdetalles';
        var idFactura = $('#ultimaFactura').val();
        var idCat = categoria;
        console.log(idCat);
        try {
            $.ajax({
                url: "./controller/04-DallitemCat.php",
                type: "POST",
                data: {
                    table: table,
                    table1: table1,
                    id: idFactura,
                    idCat: idCat
                },
                success: function() {
                    Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
                    location.reload();

                }
            });
        } catch (e) {
            Notify('Error', "Ocurrió un error al guardar --- " + e, 'error', 'fa fa-warning', 'fade', 'normal');
        }
    }












    // function addOtroDesc() {
    //     Swal
    //         .fire({
    //             title: "OTRO DESCUENTO1",
    //             input: "text",
    //             inputLabel: "Ingresar numero de factura Compra",
    //             inputPlaceholder: "Numero Factura Compra",
    //             showCancelButton: true,
    //             confirmButtonColor: "#3085d6",
    //             cancelButtonColor: "#d33",
    //             confirmButtonText: "Aplicar",
    //             cancelButtonText: "Cancelar",
    //             reverseButtons: true,
    //         })
    //         .then(resultado => {
    //             if (resultado.value) {
    //                 let valor = resultado.value;
    //                 addOtherDesc(valor);
    //             }
    //         });
    // }





    function addOtroDesc() {
        Swal.fire({
            title: "OTRO DESCUENTO",
            input: "number",
            inputLabel: "Ingrese un monto",
            inputPlaceholder: "MONTO DESCUENTO",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aplicar",
            cancelButtonText: "Cancelar",
            reverseButtons: true,
            inputValidator: (value) => {

                if (!isNaN(value) && !isNaN(parseFloat(value))) {
                    return null;
                } else {
                    return "Por favor, ingrese un número válido.";
                }
            }
        }).then(resultado => {
            if (resultado.value) {
                let valor = parseFloat(resultado.value);
                updateOtherDesc(valor);
            }
        });
    }



    function addDeducible() {
        Swal.fire({
            title: "DEDUCIBLE",
            input: "number",
            inputLabel: "Ingrese un monto DEDUCIBLE",
            inputPlaceholder: "MONTO DEDUCIBLE",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aplicar",
            cancelButtonText: "Cancelar",
            reverseButtons: true,
            inputValidator: (value) => {

                if (!isNaN(value) && !isNaN(parseFloat(value))) {
                    return null;
                } else {
                    return "Por favor, ingrese un número válido.";
                }
            }
        }).then(resultado => {
            if (resultado.value) {
                let valor = parseFloat(resultado.value);
                let controlador = "./controller/03-UValue.php";
                let columna = "deducible"
                updateValue(valor, controlador, columna);
            }
        });
    }


    function updateValue(valor, controlador, columna) {
        var table = '<?php echo $table; ?>';
        var id = $('#ultimaFactura').val();
        try {
            $.ajax({
                url: controlador,
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    valor: valor,
                    columna: columna
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        if (dataResult.estado) {
                            Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
                            dataOfInvoice();
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

        totalFactura();
    }



    function updateOtherDesc(valor) {
        var table = '<?php echo $table; ?>';
        var id = $('#ultimaFactura').val();
        var descOtros = valor;
        try {
            $.ajax({
                url: "./controller/03-U-descOtros.php",
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    descOtros: descOtros
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        if (dataResult.estado) {
                            Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
                            dataOfInvoice();
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

        totalFactura();
    }


    function updatePrecio(idR) {
        Swal.fire({
            title: "NUEVO PRECIO",
            input: "number",
            inputLabel: "Ingrese NUEVO PRECIO",
            inputPlaceholder: "NUEVO PRECIO",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Actualizar Precio",
            cancelButtonText: "Cancelar",
            reverseButtons: true,
            inputValidator: (value) => {
                if (!isNaN(value) && !isNaN(parseFloat(value))) {
                    return null;
                } else {
                    return "Por favor, ingrese un número válido.";
                }
            }
        }).then(resultado => {
            if (resultado.value) {
                let precio = parseFloat(resultado.value);
                updateP(idR, precio);
            }
        });
    }


    // agregando nueva funcion updateCP  CLIENTE PAGA, ............ similar a updatePrecio
    function updateCP(idR) {
        Swal.fire({
            title: "CLIENTE PAGA",
            input: "number",
            inputLabel: "Ingrese NUEVO PRECIO CP",
            inputPlaceholder: "CLIENTE PAGA",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "GUARDAR",
            cancelButtonText: "Cancelar",
            reverseButtons: true,
            inputValidator: (value) => {
                if (!isNaN(value) && !isNaN(parseFloat(value))) {
                    return null;
                } else {
                    return "Por favor, ingrese un número válido.";
                }
            }
        }).then(resultado => {
            if (resultado.value) {
                let precio = parseFloat(resultado.value);
                let controlador = "./controller/03-U-precioC.php";
                let columnaName = "cp"
                updatePrecioC(idR, precio, controlador, columnaName);
            }
        });
    }


    // CREANDO FUNCION updatePrecioC ................. similar a  updateP

    function updatePrecioC(idR, precio, controlador, columnaName) {
        var table = 'facturasdetalles';
        var id = idR;
        var precio = precio;
        try {
            $.ajax({
                url: controlador,
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    precio: precio,
                    columnaName: columnaName
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        if (dataResult.estado) {
                            Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
                            dataOfInvoice();
                            dataOfAte();
                            dataOfAtCliente();
                            dataOfHospitalizacion();
                            dataOfMed();
                            dataOfMat();
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
        totalFactura();
    }







    function updateP(idR, precio) {
        var table = 'facturasdetalles';
        var id = idR;
        var precio = precio;
        try {
            $.ajax({
                url: "./controller/03-U-precio-servicio.php",
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    precio: precio
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        if (dataResult.estado) {
                            Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
                            dataOfInvoice();
                            // dataOfAte();

                            dataOfAte();
                            dataOfHospitalizacion();
                            dataOfMed();
                            dataOfMat();

                            totalFactura();

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

        totalFactura();
    }





    function addTasa() {
        Swal.fire({
            title: "TASA DESCUENTO",
            input: "number",
            inputLabel: "Ingrese un monto ejemplo 20",
            inputPlaceholder: "TASA DESCUENTO",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aplicar",
            cancelButtonText: "Cancelar",
            reverseButtons: true,
            inputValidator: (value) => {
                // Validate if the input is a number (integer or decimal)
                if (!isNaN(value) && !isNaN(parseFloat(value))) {
                    return null; // Input is valid
                } else {
                    return "Por favor, ingrese un número válido."; // Input is not valid
                }
            }
        }).then(resultado => {
            if (resultado.value) {
                let valor = parseFloat(resultado.value); // Convert the input to a float
                updateTasa(valor);
            }
        });
    }


    // agreando nueva funcion  addCopago ..... similar a   addTasa() 
    function addCopago() {
        Swal.fire({
            title: "TASA COPAGO",
            input: "number",
            inputLabel: "Ingrese un monto ejemplo 20",
            inputPlaceholder: "TASA COPAGO",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Guardar",
            cancelButtonText: "Cancelar",
            reverseButtons: true,
            inputValidator: (value) => {
                // Validate if the input is a number (integer or decimal)
                if (!isNaN(value) && !isNaN(parseFloat(value))) {
                    return null; // Input is valid
                } else {
                    return "Por favor, ingrese un número válido."; // Input is not valid
                }
            }
        }).then(resultado => {
            if (resultado.value) {
                let valor = parseFloat(resultado.value); // Convert the input to a float
                let controlador = "./controller/03-updateTasa.php";
                let columna = "copago2";
                updateTasaByCol(valor, controlador, columna);
            }
        });
    }


    function updateTasaByCol(valor, controlador, columna) {
        var table = '<?php echo $table; ?>';
        var id = $('#ultimaFactura').val();
        var tasaDesc = valor;
        try {
            $.ajax({
                url: controlador,
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    tasaDesc: tasaDesc,
                    columna: columna
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        if (dataResult.estado) {
                            Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
                            dataOfInvoice();
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

        totalFactura();
    }




    function updateTasa(valor) {
        var table = '<?php echo $table; ?>';
        var id = $('#ultimaFactura').val();
        var tasaDesc = valor;
        try {
            $.ajax({
                url: "./controller/03-U-tasa.php",
                type: "POST",
                data: {
                    id: id,
                    table: table,
                    tasaDesc: tasaDesc
                },
                cache: false,
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        if (dataResult.estado) {
                            Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
                            dataOfInvoice();
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

        totalFactura();
    }




    function dataFromClient(clienteId) {
        if (clienteId == 0) {
            document.getElementById("poliza").innerHTML = '';
            document.getElementById("seguro").innerHTML = '';
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
                    $('#nombreCliente').val(response.description);
                    document.getElementById("poliza").innerHTML = '' + response.poliza;
                    document.getElementById("seguro").innerHTML = '' + response.seguro;
                }
            });
        }
    }


    function showDataD1(doctorId) {
        if (doctorId == 0) {
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
                    $('#nombreDoctor1').val(response.description);

                }
            });
        }

    }

    function showDataD2(doctorId) {
        if (doctorId == 0) {
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
                    $('#nombreDoctor2').val(response.description);

                }
            });
        }

    }

    function dataOfInvoice() {

        var fac = $('#ultimaFactura').val();

        if (fac == "0") {
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

                    if (response.tipoFactura == 1) {
                        $('#nombreOpcion').val("CREDITO");
                    }
                    if (response.tipoFactura == 2) {
                        $('#nombreOpcion').val("CONTADO");
                    }

                    if (response.copago == 1) {
                        $('.alert-status').bootstrapSwitch('state', true);

                    }
                    if (response.copago == 0) {
                        $('.alert-status').bootstrapSwitch('state', false);

                    }

                    totalFactura();

                }
            });
        }

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
                    if (dataResult.statusCode == 200) {
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
                    if (dataResult.statusCode == 200) {
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
                    if (dataResult.statusCode == 200) {
                        if (dataResult.estado) {
                            $('#modal-add-opcion').modal('toggle');
                            dataOfInvoice();
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



    function totalFactura() {
        $.ajax({
            url: './controller/readTotales.php',
            method: 'GET',
            data: {
                id: id_fact
            },
            dataType: 'json',
            success: function(response) {

                var aplica = response.copago = 1 ? "Si, si aplica copago" : "No, no aplica copago";

                document.getElementById("total1").innerHTML = 'SUB TOTAL:L ' + response.totalCA_1;
                document.getElementById("total2").innerHTML = 'SUB TOTAL:L ' + response.totalCA_2;
                document.getElementById("total3at").innerHTML = 'SUB TOTAL:L ' + response.totalCA_3;
                document.getElementById("total4Mat").innerHTML = 'SUB TOTAL:L ' + response.totalCA_4;
                document.getElementById("total5").innerHTML = 'SUB TOTAL:L ' + response.totalCA_5;

                document.getElementById("total3").innerHTML = 'L ' + response.colTOTAL; //SUBTOTAL
                document.getElementById("descuento0").innerHTML = 'L ' + response.colDESCU; //DESCUENTO
                document.getElementById("otherDesc").innerHTML = 'L ' + response.colOTROD; //OTROS DESCUENTOS                
                document.getElementById("total4").innerHTML = 'L ' + response.colSUBTO; //TOTAL                
                document.getElementById("valorCP2").innerHTML = 'L ' + response.colCOPA2; //VALOR COPAGO
                document.getElementById("totalCP").innerHTML = 'L ' + response.colNOELE; //NO ELEGIBLE
                document.getElementById("deducible").innerHTML = 'L ' + response.colDEDUC; //DEDUCIBLE
                document.getElementById("totalTP_").innerHTML = 'L ' + response.colTOPAG; //TOTAL A PAGAR


                document.getElementById("btnTasa").innerHTML = response.colTASDE + "%";
                document.getElementById("btnCP2").innerHTML = response.colTASAC + "%";


                // if (response.copago) {
                //     document.getElementById("valor").innerHTML = parseInt(response.copagoP, 10).toFixed(2);
                // } else {

                //     document.getElementById("valor").innerHTML = "0";
                // }

                guardarImprimir.style.display = "none";
                resumen.style.display = "none";

                if (parseInt(response.colTOTAL, 10) == 0) {
                    resumen.style.display = "none";
                    guardarImprimir.style.display = "none";
                }
                if (parseInt(response.colTOTAL, 10) > 0) {
                    resumen.style.display = "flex";
                    guardarImprimir.style.display = "inline";
                }


                // console.log('el tipo de valor totalP ' + typeof response.colTOTAL);
                // console.log('================================');
                // console.log('FACTURA ID: ' + response.factId);
                // console.log('TOTAL ATEN: ' + response.tAte);
                // console.log('TOTAL MEDI: ' + response.tMed);
                // console.log('TOTAL MATE: ' + response.tMat);
                // console.log('TOTAL HOSP: ' + response.tHospitalizacion);
                // console.log('SUBTOTAL..: ' + response.tAseg);
                // console.log('TASA DE CA: ' + response.tasaDesc + '% => (' + response.desc1 + ')');
                // console.log('DESCUENTO1: ' + response.desc1);
                // console.log('OTRO DESCU: ' + response.descOtros);
                // console.log('NETO PAGAR: ' + response.colTOTAL);
                // console.log('APL COPAGO: ' + aplica);
                // console.log('COPAGO VAL: ' + response.copagoP);
                // console.log('================================');


            },
            error: function(xhr, status, errorThrown) {
                console.error('Error fetching data - Status:', xhr.status, 'Error:', errorThrown);
            }
        });
    }
</script>