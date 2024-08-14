<?php
include_once '../../0-includes/0-conn.php';
$id = $_POST['id'];
$table = $_POST['table'];
$doctor1id = $_POST['doctor1id'];


$sql =  "UPDATE $table SET doctor1id = '$doctor1id' WHERE id = $id";

if ($doctor1id == "") {
    $id = 400;
    $post_data = array(
        'statusCode' => 201,
        'estado' => false,
        'mensaje' => "vacio",
        'id' => $id
    );
} else {

    if ($conn->query($sql)) {
        $id = 200;
        $post_data = array(
            'statusCode' => 200,
            'estado' => true,
            'mensaje' => "Doctor 1 Actualizado con exito",
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
}


echo json_encode($post_data);
