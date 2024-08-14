<?php

include '../0-includes/0-session.php';
if ($user['quantity'] == 1 || $user['quantity'] == 2) {
} else {
  $_SESSION['error'] = 'Usuarios no cuenta con permisos! o ha caducado su sesion';
  header('location: ../index.php');
}

$moduleSelectName = 'usuarios';
$moduleName = "Usuarios";
$singular = "Usuario";
$plural = "Usuarios";
$table = "usuarios";

$campo0 = "Id";
$field0 = "id";

$campo1 = "Nombre";
$field1 = "description";

$campo2 = "Especialidad/Poliza";
$field2 = "poliza";


$campo3 = "Telefono/Certificado";
$field3 = "certificado";


// $campo4 ="Nombre";
// $field4 ="description";


// $campo5 ="Nombre";
// $field5 ="description";


$campo6 = "Tipo";
$field6 = "quantity";



$campo7 = "Usuario";
$field7 = "username";

$campo8 = "Contraseña";
$field8 = "password";


$campo9 = "Foto";
$field9 = "photo";
