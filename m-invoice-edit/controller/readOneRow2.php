<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$id = $_GET['id'];
$ultimoId = $_GET['ultimoId'] == 0 ? "(SELECT id FROM facturas WHERE status = 1)" : $_GET['ultimoId'];

$sql = "SELECT FORMAT(sum((f.quantity * f.precioP)),2) as total1
FROM $table as f
inner join categorias as c on c.id = f.price 
WHERE f.description = $ultimoId AND f.status=1";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
echo json_encode($row);