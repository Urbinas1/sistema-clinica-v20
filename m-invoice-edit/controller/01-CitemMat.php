<?php
include_once '../../0-includes/0-conn.php';
$table = $_POST['table'];

$idFact = $_POST['idFact'];
$idAtt = $_POST['idAtt'];
$quantity = $_POST['quantity'];


$sql =  "INSERT INTO $table (description, quantity, price,status ) VALUES ('$idFact', $quantity ,'$idAtt',4)";//estatus es la categoria
//echo $sql;

if ($conn->query($sql)) {
    //echo 'guardado con exito, query utilizado: ' . $sql;
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
        'mensaje' => "error: " + $conn->error,
        'id' => $id
    );
}
$conn->close();
echo json_encode($post_data);
