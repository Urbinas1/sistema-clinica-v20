<?php
include_once '../../0-includes/0-conn.php';
$id = $_POST['id'];
$table = $_POST['table'];
$quantity = $_POST['quantity'];

$quantity = $quantity - 1;

if ($quantity == 0) {
    $quantity = 1;
}

$sql =  "UPDATE $table SET quantity = '$quantity' WHERE id = $id";



    if ($conn->query($sql)) {
        $id = 200;
        $post_data = array(
            'statusCode' => 200,
            'estado' => true,
            'mensaje' => "catnitdad disminuir 1 Actualizado con exito",
            'id' => $id
        );
    } else {
        $id = 400;
        $post_data = array(
            'statusCode' => 201,
            'estado' => false,
            'mensaje' => "error: " + $conn->error + ' sql utilizado: ' + $sql,
            'id' => $id
        );
    }
    $conn->close();



echo json_encode($post_data);
