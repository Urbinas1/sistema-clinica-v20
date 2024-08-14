<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$ultimoId = $_GET['ultimoId'] == 0 ? "(SELECT id FROM facturas WHERE status = 1)" : $_GET['ultimoId'];

$sql = "SELECT * FROM $table WHERE id = $ultimoId";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
echo json_encode($row);
