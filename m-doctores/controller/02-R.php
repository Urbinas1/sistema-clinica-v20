<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$sql = "SELECT *,CONCAT('<button type=\"button\" class=\"btn btn-warning btn-sm\" onclick=\"updateR(',id,')\"><i class=\"fa fa-edit \">
</i> EDITAR  </button>',' ','<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"deleteR(',id,')\"><i class=\"fa fa-trash \">
</i> ELIMINAR  </button>')  as options FROM $table WHERE status = 1 and quantity = 2";

//$sql = "SELECT *, 'options' as options FROM $table";//consulta para pruebas rapidas

$query = $conn->query($sql);
$query2 = $conn->query($sql);
$row = $query->fetch_assoc();

$array = array();
if (is_null($row)) {
    echo json_encode(['data' => null]);
} else {    
     while ($row2 = $query2->fetch_assoc()) {
         $array[] = $row2;
     }
     echo json_encode(['data' => $array]);
}

//echo json_encode(['data' => [$row]]);