<?php
include '../0-includes/0-session.php';
if ($user['quantity'] == 1 || $user['quantity'] == 2) {
} else {
  $_SESSION['error'] = 'Usuarios no cuenta con permisos! o ha caducado su sesion';
  header('location: ../index.php');
}
$moduleSelectName = 'clientes';
$moduleName = "Clientes";
$singular = "Cliente";
$plural = "Clientes";
$table = "usuarios";


include_once '../0-includes/0-html-start.php';
include_once '../0-includes/1-html-head.php';
include_once '../0-includes/2-html-nav.php';
include_once '../0-includes/3-html-aside.php';
