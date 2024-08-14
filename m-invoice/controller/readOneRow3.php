<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$id = $_GET['id'];
$sql = "SELECT FORMAT(sum(f.quantity * m.price),2) as total1 
FROM $table as f
inner join medicinas as m on m.id = f.price 
WHERE f.description = (SELECT id FROM facturas  where status = 1 order by id desc limit 1) AND f.status=0";
//echo $sql;
$query = $conn->query($sql);
$row = $query->fetch_assoc();
echo json_encode($row);