<?php 

$appName = "idariSoft";
$htmlLanguage = "es";
$userLogName = $user['description'];

$userLogRol = ($user['quantity'] == 1) ? 'Administrador' : (($user['quantity'] == 2) ? 'Doctor' : (($user['quantity'] == 3) ? 'Paciente' : 'user n/a') );
//$userLogName = $user['username'];
//$userLogName = $user['username'];


$timezone = 'America/Managua';
date_default_timezone_set($timezone);
$fecha_y_hora_actual = date("Y-m-d H:i:s");
//$fecha_actual = date("Y-m-d");

$fecha_actual = ".. ".date("d/m/Y");


$hora_actual = date("H:i:s");
$fecha_actual_ni = date("d/m/Y");
$hora_actual_ni = date("h:i:s");
$hoy=$fecha_actual;
//setlocale(LC_MONETARY, 'es_HN.UTF-8');
setlocale(LC_MONETARY, 'es_NI.UTF-8');

?>

<!DOCTYPE html>
<html lang="<?php echo $htmlLanguage;?>"></html>