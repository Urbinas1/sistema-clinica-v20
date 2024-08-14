<?php
include_once '../../0-includes/0-conn.php';

$table = $_GET['table'];

$description = $_GET['description'];

$sql = "SELECT * FROM $table WHERE description like '$description' AND status=1";

$query = $conn->query($sql);
$row = $query->fetch_assoc();
echo json_encode($row);