<?php
include_once '../../0-includes/0-conn.php';

$table = $_POST['table'];
$idFact = $_POST['idFact'];
$idAtt = $_POST['idAtt'];


$sqlFetch = "SELECT price FROM categorias WHERE id = '$idAtt'";
$result = $conn->query($sqlFetch);
$row = $result->fetch_assoc();
$price = $row['price'];


$sqlInsert = "INSERT INTO $table (description, quantity, price, precioP) VALUES ('$idFact', 1, '$idAtt', '$price')";

if ($conn->query($sqlInsert)) {
    $id = 200;
    $post_data = array(
        'statusCode' => 200,
        'estado' => true,
        'mensaje' => "detalle guardado con exito",
        'id' => $id
    );
} else {
    $id = 400;
    $post_data = array(
        'statusCode' => 201,
        'estado' => false,
        'mensaje' => "error: " . $conn->error,
        'id' => $id
    );
}

$conn->close();
echo json_encode($post_data);

