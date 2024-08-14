<?php

include '../0-includes/0-session.php';
if($user['quantity'] == 1 || $user['quantity'] == 2 ){

}
else{
  $_SESSION['error'] = 'Usuarios no cuenta con permisos! o ha caducado su sesion';  
  header('location: ../index.php');
}

$moduleSelectName = 'doctores';
$moduleName = "Doctores";
$singular = "Doctor";
$plural = "Doctores";
$table = "usuarios";

$campo0 ="Id";
$field0 ="id";

$campo1 ="Nombre Doctor.";
$field1 ="description";

$campo2 ="Especialidad Doctor.";
$field2 ="poliza";


$campo3 ="Telefono Doctor.";
$field3 ="certificado";


// $campo4 ="Nombre";
// $field4 ="description";


// $campo5 ="Nombre";
// $field5 ="description";