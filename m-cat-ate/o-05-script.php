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




  // $(function () {

  //   $("#example1").DataTable({
  //     "responsive": true, "lengthChange": false, "autoWidth": false,
  //     "buttons": ["copy", "csv", "excel", "pdf", "print"]
  //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  // });


  $(document).ready(function() {
    ReadDatos();
    
    // CargarEmpresas();
    // CargarSucursales(1);
    // CargarRoles(1);

    // CargarEmpresas_edit();
    // CargarSucursales_edit(1);
    // CargarRoles_edit(1);
  })


  //CREATE
  // function CreateModal() {
  //     document.getElementById("btnInsertar").disabled = false;
  //     $('#CreateModal').modal('show');
  // }
  // function CreateData() {
  //     var idempresa = $("#selectEmpresas").val();
  //     var idsucursal = $("#selectEmpresasSucursales").val();
  //     var idrol = $("#selectRoles").val();
  //     var nombre = $("#nombre").val();
  //     var usuario = $("#usuario").val();
  //     var clave = $("#clave").val();
  //     var correo = $("#correo").val();
  //     var creadopor = 0;
  //     var cedula = $("#cedula").val();
  //     var activo = $("#selectActivo").val();

  //     try {


  //         let obj = {
  //             idEmpresa: idempresa,
  //             idSucursal: idsucursal,
  //             idRol: idrol,
  //             nombre: nombre,
  //             usuario: usuario,
  //             clave: clave,
  //             correo: correo,
  //             creadoPor: creadopor,
  //             cedula: cedula,
  //             activo: activo
  //         };

  //         console.log(obj)

  //         $.ajax({
  //             url: "/Usuario/create",
  //             method: 'POST',
  //             async: false,
  //             contentType: "application/json charset=utf-8",
  //             data: JSON.stringify({ user: obj }),
  //             success: function (result) {
  //                 $('#CreateModal').modal('toggle');
  //                 if (result.estado) {
  //                     Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
  //                     ReadDatos();
  //                 } else {
  //                     Notify('Error', result.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
  //                     if (!result.sesion) {
  //                         setTimeout(function () {
  //                             url = "/Acceso/Login";
  //                             window.location.href = url;
  //                         }, 2000);//1 segundos
  //                     }
  //                 }
  //             }
  //         });
  //     } catch (e) {
  //         Notify('Error', "Ocurrió un error al guardar" + e, 'error', 'fa fa-warning', 'fade', 'normal');
  //         document.getElementById("btnGuardarTraslado").disabled = false;
  //     }
  // }

  //READ
  function ReadDatos() {
    var table = "<?php echo $table; ?>";
    $('#example1').DataTable({
      destroy: true,
      responsive: true,
      error: true,
      "ajax": {
        "url": "./controller/read.php",
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
        // {
        //   defaultContent: '',
        //   "data": "quantity"
        // },
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


  // function ReadOneRow(idUsuario) {
  //     $.ajax({
  //         url: "/Usuario/oneRow",
  //         type: "Get",
  //         datatype: "json",
  //         data: { idUsuario: idUsuario },
  //         success: function (data) {
  //             console.log(data)
  //             $('#edit_nombre').val(data.data[0].nombre)
  //             $('#edit_usuario').val(data.data[0].usuario)
  //             $('#edit_correo').val(data.data[0].correo)
  //             $('#edit_cedula').val(data.data[0].cedula)
  //             $("#edit_selectEmpresas").select2("val", data.data[0].idEmpresa.toString());
  //             $("#edit_selectEmpresasSucursales").select2("val", data.data[0].idSucursal.toString());
  //             $("#edit_selectRoles").select2("val", data.data[0].idRol.toString());
  //             var estado = data.data[0].activo ? "1" : "0";
  //             $("#edit_selectActivo").select2("val", estado);
  //         }
  //     });
  // }

  // //UPDATE
  // function UpdateModal(id) {
  //     document.getElementById("btnGuardar").disabled = false;
  //     ReadOneRow(id);
  //     $('#idrowU').val(id);
  //     $('#UpdateModal').modal('show');
  // }
  // function UpdateData() {
  //     var idusuario = $("#idrowU").val();
  //     var idempresa = $("#edit_selectEmpresas").val();
  //     var idsucursal = $("#edit_selectEmpresasSucursales").val();
  //     var idrol = $("#edit_selectRoles").val();
  //     var nombre = $("#edit_nombre").val();
  //     var usuario = $("#edit_usuario").val();
  //     var clave = '';
  //     var correo = $("#edit_correo").val();
  //     var creadopor = 0;
  //     var cedula = $("#edit_cedula").val();
  //     var activo = $("#edit_selectActivo").val();

  //     try {
  //         let obj = {
  //             idUsuario: idusuario,
  //             idEmpresa: idempresa,
  //             idSucursal: idsucursal,
  //             idRol: idrol,
  //             nombre: nombre,
  //             usuario: usuario,
  //             clave: clave,
  //             correo: correo,
  //             creadoPor: creadopor,
  //             cedula: cedula,
  //             activo: activo
  //         };

  //         console.log(obj)

  //         $.ajax({
  //             url: "/Usuario/update",
  //             method: 'POST',
  //             async: false,
  //             contentType: "application/json charset=utf-8",
  //             data: JSON.stringify({ user: obj }),
  //             success: function (result) {

  //                 $('#UpdateModal').modal('toggle'); 0
  //                 //wnd.center().close();

  //                 if (result.estado) {
  //                     Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');


  //                     ReadDatos();
  //                     //limpiar();

  //                 } else {
  //                     Notify('Error', result.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
  //                     if (!result.sesion) {

  //                         setTimeout(function () {
  //                             url = "/Acceso/Login";
  //                             window.location.href = url;
  //                         }, 2000);//1 segundos
  //                     }

  //                 }

  //                 /*$("#loader-mediumR").hide();*/
  //             }
  //         });
  //     } catch (e) {
  //         Notify('Error', "Ocurrió un error al guardar" + e, 'error', 'fa fa-warning', 'fade', 'normal');
  //         //document.getElementById("btnGuardarTraslado").disabled = false;
  //     }


  // }

  // //DELETE
  // function DeleteModal(id) {
  //     document.getElementById("btnEliminar").disabled = false;
  //     $('#idrowD').val(id);
  //     $('#DeleteModal').modal('show');
  // }
  // function DeleteData() {

  //     try {
  //         let obj = {
  //             idUsuario: $("#idrowD").val(),
  //         };

  //         console.log(obj)

  //         $.ajax({
  //             url: "/Usuario/delete",
  //             method: 'POST',
  //             async: false,
  //             contentType: "application/json charset=utf-8",
  //             data: JSON.stringify({ user: obj }),
  //             success: function (result) {

  //                 $('#DeleteModal').modal('toggle'); 0
  //                 //wnd.center().close();

  //                 if (result.estado) {
  //                     Notify('Confirmación', "Operación completada", 'success', 'fa fa-check-square', 'fade', 'normal');
  //                     ReadDatos();
  //                     //limpiar();

  //                 } else {
  //                     Notify('Error', result.mensaje, 'error', 'fa fa-warning', 'fade', 'normal');
  //                     if (!result.sesion) {
  //                         setTimeout(function () {
  //                             url = "/Acceso/Login";
  //                             window.location.href = url;
  //                         }, 2000);//1 segundos
  //                     }
  //                 }
  //             }
  //         });
  //     } catch (e) {
  //         Notify('Error', "Ocurrió un error al guardar" + e, 'error', 'fa fa-warning', 'fade', 'normal');
  //         //document.getElementById("btnGuardarTraslado").disabled = false;
  //     }


  // }



  // //load select
  // function CargarEmpresas() {
  //     $.ajax({
  //         url: "/Usuario/showEmpresas",
  //         type: "Get",
  //         datatype: "json",
  //         success: function (data) {
  //             var opt = new Option('Seleccione una Empresa', '');
  //             $('#selectEmpresas').append(opt);
  //             for (var i = 0; i < data.data.length; i++) {
  //                 var opt = new Option(data.data[i].descripcion, data.data[i].id);
  //                 $('#selectEmpresas').append(opt);
  //             }
  //         }
  //     });
  // }
  // function CargarEmpresas_edit() {
  //     $.ajax({
  //         url: "/Usuario/showEmpresas",
  //         type: "Get",
  //         datatype: "json",
  //         success: function (data) {
  //             var opt = new Option('Seleccione una Empresa', '');
  //             $('#edit_selectEmpresas').append(opt);
  //             for (var i = 0; i < data.data.length; i++) {
  //                 var opt = new Option(data.data[i].descripcion, data.data[i].id);
  //                 $('#edit_selectEmpresas').append(opt);
  //             }
  //         }
  //     });
  // }

  // function CargarSucursales(empresaId) {
  //     $.ajax({
  //         url: "/Usuario/showEmpresaSucursales",
  //         type: "Get",
  //         datatype: "json",
  //         data: { empresaId: empresaId },
  //         success: function (data) {
  //             var opt = new Option('Seleccione una Sucursal', '');
  //             $('#selectEmpresasSucursales').append(opt);
  //             for (var i = 0; i < data.data.length; i++) {
  //                 var opt = new Option(data.data[i].descripcion, data.data[i].id);
  //                 $('#selectEmpresasSucursales').append(opt);
  //             }
  //         }
  //     });
  // }
  // function CargarSucursales_edit(empresaId) {
  //     $.ajax({
  //         url: "/Usuario/showEmpresaSucursales",
  //         type: "Get",
  //         datatype: "json",
  //         data: { empresaId: empresaId },
  //         success: function (data) {
  //             var opt = new Option('Seleccione una Sucursal', '');
  //             $('#edit_selectEmpresasSucursales').append(opt);
  //             for (var i = 0; i < data.data.length; i++) {
  //                 var opt = new Option(data.data[i].descripcion, data.data[i].id);
  //                 $('#edit_selectEmpresasSucursales').append(opt);
  //             }
  //         }
  //     });
  // }

  // function CargarRoles(empresaId) {
  //     $.ajax({
  //         url: "/Usuario/showRoles",
  //         type: "Get",
  //         datatype: "json",
  //         data: { empresaId: empresaId },
  //         success: function (data) {
  //             var opt = new Option('Seleccione un Rol', '');
  //             $('#selectRoles').append(opt);
  //             for (var i = 0; i < data.data.length; i++) {
  //                 var opt = new Option(data.data[i].descripcion, data.data[i].idRol);
  //                 $('#selectRoles').append(opt);
  //             }
  //         }
  //     });
  // }
  // function CargarRoles_edit(empresaId) {
  //     $.ajax({
  //         url: "/Usuario/showRoles",
  //         type: "Get",
  //         datatype: "json",
  //         data: { empresaId: empresaId },
  //         success: function (data) {
  //             var opt = new Option('Seleccione un Rol', '');
  //             $('#edit_selectRoles').append(opt);
  //             for (var i = 0; i < data.data.length; i++) {
  //                 var opt = new Option(data.data[i].descripcion, data.data[i].idRol);
  //                 $('#edit_selectRoles').append(opt);
  //             }
  //         }
  //     });
  // }


  // function Notify(title, text, icon, confirmButtonText, iconColor, animation, toast) {
  //     Swal.fire({
  //         title: title,
  //         text: text,
  //         icon: icon,
  //         iconColor: iconColor,
  //         animation: animation,
  //         toast: toast
  //     });
  // }
  // //monitoreo
  // $(function () {
  //     $('#selectEmpresas').on("change", function (e) {
  //         console.log('selectEmpresas: ' + $("#selectEmpresas").val())
  //     });

  //     $('#selectEmpresasSucursales').on("change", function (e) {
  //         console.log('selectEmpresasSucursales: ' + $("#selectEmpresasSucursales").val())
  //     });

  //     $('#selectRoles').on("change", function (e) {
  //         console.log('selectRoles: ' + $("#selectRoles").val())
  //     });

  //     $('#selectActivo').on("change", function (e) {
  //         console.log('selectActivo: ' + $("#selectActivo").val())
  //     });



  //     $('#edit_selectEmpresas').on("change", function (e) {
  //         console.log('edit_selectEmpresas: ' + $("#edit_selectEmpresas").val())
  //     });

  //     $('#edit_selectEmpresasSucursales').on("change", function (e) {
  //         console.log('edit_selectEmpresasSucursales: ' + $("#edit_selectEmpresasSucursales").val())
  //     });

  //     $('#edit_selectRoles').on("change", function (e) {
  //         console.log('edit_selectRoles: ' + $("#edit_selectRoles").val())
  //     });

  //     $('#edit_selectActivo').on("change", function (e) {
  //         console.log('edit_selectActivo: ' + $("#edit_selectActivo").val())
  //     });



  // });


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
        $('#edit_price').val(response.price);
      }
    });




  }
</script>