<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$id = $_GET['id'];
$sql = "


SELECT 
    (SELECT IFNULL(SUM(f.quantity * f.precioP), 0) 
     FROM facturasdetalles AS f
     INNER JOIN categorias AS c ON c.id = f.price 
     WHERE f.description = (SELECT id FROM facturas WHERE status = 1 ORDER BY id DESC LIMIT 1) AND f.status = 1) 
+
    (SELECT IFNULL(SUM(f.quantity * m.price), 0) 
     FROM facturasdetalles AS f
     INNER JOIN medicinas AS m ON m.id = f.price 
     WHERE f.description = (SELECT id FROM facturas WHERE status = 1 ORDER BY id DESC LIMIT 1) AND f.status = 0) 
AS totalR;

";
//echo $sql;
$query = $conn->query($sql);
$row = $query->fetch_assoc();
echo json_encode($row);
