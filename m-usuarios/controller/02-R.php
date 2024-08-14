<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$sql = "SELECT *,
CONCAT(
    '<button type=\"button\" class=\"btn btn-warning btn-sm\" onclick=\"updateR(', id, ')\"><i class=\"fa fa-edit\"></i> EDITAR </button>',
    ' ',
    '<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"deleteR(', id, ')\"><i class=\"fa fa-trash\"></i> ELIMINAR </button>'
) AS options,
CONCAT(
    '<img src=\"',
    IF(photo IS NULL, '../recursos/img/user-default.png', CONCAT('../recursos/img/', photo)),
    '\" class=\"img-circle\" alt=\"User Image\" width=\"50px\" height=\"50px\"> <span style=\"color:blue;\" class=\"fa fa-edit\" onclick=\"updatePhoto(', id, ')\"></span>'
) AS foto,
IF(quantity = 1, 'ADMINISTRADOR', IF(quantity = 2, 'DOCTOR', IF(quantity = 3, 'PACIENTE', ''))) AS type
FROM usuarios
WHERE status = 1;
";



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