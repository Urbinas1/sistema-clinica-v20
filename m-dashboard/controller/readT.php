<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$table1 = $_GET['table1'];
$ini = $_GET['ini'];
$fin = $_GET['fin'];

$sql = "SELECT
sum(
IF(fa.copago>0, 

( select (
    (SELECT sum(f.quantity * c.price) as total1 FROM $table1 as f inner join categorias as c on c.id = f.price WHERE f.description = fa.id AND f.status=1) + (SELECT sum(f.quantity * m.price) as total1 FROM $table1 as f inner join medicinas as m on m.id = f.price WHERE f.description = fa.id AND f.status=0)    
) * 1.20 ) 
,
( select (
    (SELECT sum(f.quantity * c.price) as total1 FROM $table1 as f inner join categorias as c on c.id = f.price WHERE f.description = fa.id AND f.status=1) + (SELECT sum(f.quantity * m.price) as total1 FROM $table1 as f inner join medicinas as m on m.id = f.price WHERE f.description = fa.id AND f.status=0)    
)  ) )
) as total
    
FROM $table fa
INNER JOIN usuarios as u ON u.id = fa.clienteId
WHERE date(fa.created) BETWEEN '$ini' AND '$fin';";




$query = $conn->query($sql);
$row = $query->fetch_assoc();
echo json_encode($row);