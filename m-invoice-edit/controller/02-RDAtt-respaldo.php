<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];

$sql = "SELECT 
f.id, 
c.description as atencion, 


CONCAT('<button type=\"button\" class=\"btn btn-secondary btn-xs\" id=\"btnPrecio',f.id,'\" onclick=\"updatePrecio(',f.id,')\">', FORMAT(f.quantity * c.price, 2)  ,'</button>') as total ,

'0' as cubreP, 
FORMAT(f.quantity * c.price, 2) as cubreA,
CONCAT('<button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"deleteAtt(', f.id, ')\"><i class=\"fa fa-trash \"></i>   </button>') as options 
FROM 
$table as f 
INNER JOIN 
categorias as c 
ON 
c.id = f.price 
WHERE 
f.description = (SELECT id FROM facturas WHERE status = 1) 
AND f.status = 1;";

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

