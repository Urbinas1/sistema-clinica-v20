<?php
include_once '../../0-includes/0-conn.php';
$table = $_GET['table'];
$id = $_GET['id'];
$sql = "SELECT * FROM $table WHERE id = $id WHERE status = 1";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
echo json_encode($row);