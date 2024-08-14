<?php

include '../0-includes/0-session.php';
if($user['quantity'] == 1 || $user['quantity'] == 2 ){

}
else{
  $_SESSION['error'] = 'Usuarios no cuenta con permisos! o ha caducado su sesion';  
  header('location: ../index.php');
}

$moduleSelectName = 'sala_cuna';
$moduleName = "sala_cuna";
$table = "sala_cuna";