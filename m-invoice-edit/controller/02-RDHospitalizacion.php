<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$ultimoId = $_GET['ultimoId'] == 0 ? "(SELECT id FROM facturas WHERE status = 1)" : $_GET['ultimoId'];

$sql = "SELECT 
f.id, 
c.description as atencion, 

CONCAT('<button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"btnPrecio',f.id,'\" onclick=\"updatePrecio(',f.id,')\">', FORMAT(f.quantity * f.precioP, 2)  ,'</button>') as total ,

CONCAT('<button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"btnCP',f.id,'\" onclick=\"updateCP(',f.id,')\">', FORMAT( f.cp, 2)  ,'</button>') as cubreP ,


FORMAT((f.quantity * f.precioP) -  f.cp, 2) as cubreA,

CONCAT('<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"deleteItem(', f.id, ')\"><i class=\"fa fa-trash \"></i>   </button>') as options 
FROM 
$table as f 
INNER JOIN 
hospitalizacion as c 
ON 
c.id = f.price 
WHERE 
f.description = $ultimoId
AND f.status = 5;";//es la categoria es la categoria 5 hospitalizacion

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




