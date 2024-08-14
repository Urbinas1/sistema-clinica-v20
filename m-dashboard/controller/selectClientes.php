<?php
include_once '../../0-includes/0-conn.php';
//$table = $_GET['table'];
$table = 'usuarios';
//price 1 admin, 2 doctror, 3 paciente(cliente)
$sql = "SELECT id, description FROM $table WHERE status = 1 and quantity like '3.00' ";
$query = $conn->query($sql);

$json = [];

while($row = $query->fetch_assoc()){
     $json[] = ['id'=>$row['id'], 'description'=>$row['description']];
}

$datos = array("data" => $json);

echo json_encode($datos);

//var_dump($datos2);

//var_dump($datos);

