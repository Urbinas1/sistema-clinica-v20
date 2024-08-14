<?php
include_once '../../0-includes/0-conn.php';
$tabla = $_GET['table'];
$sql = "SELECT *,CONCAT('<button type=\"button\" class=\"btn btn-warning btn-sm\" onclick=\"updateR(',id,')\"><i class=\"fa fa-edit \">
</i> Editar  </button>',' ','<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"deleteR(',id,')\"><i class=\"fa fa-trash \">
</i> Eliminar  </button>')  as options FROM $tabla WHERE status = 1";
//$sql = "SELECT *, 'options' as options  FROM $tabla";//consulta para pruebas rapidas
$query = $conn->query($sql);
$query2 = $conn->query($sql);
$row = $query->fetch_assoc();
$array = array();
if (is_null($row)) {
    echo json_encode(['data' => null]);
} else {
    //echo count($row);
    while ($row2 = $query2->fetch_assoc()) {
        $array[] = $row2;
    }
    echo json_encode(['data' => $array]);
}
