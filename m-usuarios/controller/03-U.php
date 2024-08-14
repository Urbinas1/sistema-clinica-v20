<?php
include_once '../../0-includes/0-conn.php';
$id = $_POST['id'];
$table = $_POST['table'];
$description = $_POST['description'];
$poliza = $_POST['poliza'];
$certificado = $_POST['certificado'];
$quantity = $_POST['quantity'];

$sql =  "UPDATE $table SET description = '$description', quantity = '$quantity', poliza = '$poliza', certificado = '$certificado' WHERE id = $id";

if ($conn->query($sql)) {    
    $id = 200;
    $post_data = array(
        'statusCode' => 200,
        'estado' => true,
        'mensaje' => "Actualizado con exito",
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
