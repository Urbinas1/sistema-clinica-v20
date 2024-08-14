<?php

include '../0-includes/0-session.php';
if($user['quantity'] == 1 || $user['quantity'] == 2 ){

}
else{
  $_SESSION['error'] = 'Usuarios no cuenta con permisos! o ha caducado su sesion';  
  header('location: ../index.php');
}

$moduleSelectName = 'invoice';
$moduleName = "FACTURACION";
$table = "facturas";
$table1 = "facturasdetalles";

$idfact = isset($_GET['idfact']) ? intval($_GET['idfact']) : false ;
//echo 'idfact = ['.$idfact.']';
//var_dump($idfact);