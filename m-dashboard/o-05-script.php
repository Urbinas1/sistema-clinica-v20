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
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/moment/locale/es.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>

<script>
    $(function() {

        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#reservation').daterangepicker()
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })

        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Hoy': [moment(), moment()],
                    'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                    'ultimo 30 dias': [moment().subtract(29, 'days'), moment()],
                    'Este mes': [moment().startOf('month'), moment().endOf('month')],
                    'Mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(-1, 'days'),
                endDate: moment()
            },
            function(start, end) {
                console.log('rango seleccionado: ' + start.format('YYYY-MM-D') + ' ' + end.format('YYYY-MM-D'));

                let text = start.format('YYYY-MM-DD') + ' ' + end.format('YYYY-MM-DD');
                const dateRange = text.split(" ");
                let ini = dateRange[0];
                let fin = dateRange[1];

                ReadDatos(ini, fin);
                totales(ini, fin);
                document.getElementById("reservationx").value = start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY');
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

            }
        )








    });


    $(document).ready(function() {
        // Set custom range text
        $('[data-range-key="Custom Range"]').text('Rango personalizado');

        // Get today's date
        const now = new Date();

        // Format today's date using moment.js
        const dateString = moment(now).locale('es').format('DD/MM/YYYY');
        $('#reservationx').val(`${dateString} - ${dateString}`);

        // Format today's date for Managua, Nicaragua
        const options = {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            timeZone: 'America/Managua'
        };
        const formatter = new Intl.DateTimeFormat('es-NI', options);
        const [{
            value: day
        }, , {
            value: month
        }, , {
            value: year
        }] = formatter.formatToParts(now);

        const formattedDate = `${year}-${month}-${day}`;
        console.log('hoy es: ' + formattedDate);

        // Call ReadDatos with the formatted date
        ReadDatos(formattedDate, formattedDate);
    });


    function showDate() {
        console.log('fecha seleccionada: ' + document.getElementById("reservationx").value);
    }




    function totales(ini, fin) {
        var table = "<?php echo $table; ?>";
        var table1 = "<?php echo $table1; ?>";
        console.log('table: ' + table + ' table1: ' + table1 + ' fechaIni: ' + ini + ' fechaFin: ' + fin);
        $.ajax({
            type: 'GET',
            url: 'controller/readT.php',
            data: {
                table: table,
                table1: table1,
                ini: ini,
                fin: fin
            },
            dataType: 'json',
            success: function(response) {
                console.log('total obtenido: ' + response.total)
                document.getElementById("total").innerHTML = 'TOTAL:.... L ' + response.total;
            }
        });
    }

    function goToNewUrlWithId(idfact) {
        // Base URL where you want to navigate
        var baseUrl = "../m-invoice-edit/index.php";

        // Construct the URL with the parameter
        var urlWithId = baseUrl + "?idfact=" + encodeURIComponent(idfact);

        // Navigate to the constructed URL
        window.location.href = urlWithId;
    }

    //READ
    function ReadDatos(dIni, dFin) {
        var table = "<?php echo $table; ?>";
        var table1 = "<?php echo $table1; ?>";
        console.log('table: ' + table + ' table1: ' + table1 + ' dIni: ' + dIni + ' dFin: ' + dFin);
        $('#example1').DataTable({
            searching: false,
            destroy: true,
            responsive: true,
            error: true,
            dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
            ajax: {
                url: "./controller/read.php",
                type: "GET",
                datatype: "json",
                data: {
                    table: table,
                    table1: table1,
                    ini: dIni,
                    fin: dFin // Removed trailing comma here
                },
                dataSrc: function(data) {
                    if (data.data == null) {
                        return [];
                    } else {
                        return data.data;
                    }
                }
            },
            columns: [{
                    defaultContent: '',
                    data: "n"
                },
                {
                    defaultContent: '',
                    data: "poliza"
                },
                {
                    defaultContent: '',
                    data: "certificado"
                },
                {
                    defaultContent: '',
                    data: "factura"
                },
                {
                    defaultContent: '',
                    data: "fechaA"
                },
                {
                    defaultContent: '',
                    data: "asegurado"
                },
                {
                    defaultContent: '',
                    data: "subTotalCA"
                },
                {
                    defaultContent: '',
                    data: "Desc1"
                },
                {
                    defaultContent: '',
                    data: "Desc2"
                },
                {
                    defaultContent: '',
                    data: "total1"
                },
                {
                    defaultContent: '',
                    data: "copago"
                },
                
                {
                    defaultContent: '',
                    data: "noElegible"
                },

                {
                    defaultContent: '',
                    data: "deducible"
                },
                {
                    defaultContent: '',
                    data: "TOTAL"
                },

                {
                    defaultContent: '',
                    data: "options"
                }
            ],
            order: [
                [4, "asc"]
            ] // Order by the fifth column (fechaA) descending

        });
    }
</script>