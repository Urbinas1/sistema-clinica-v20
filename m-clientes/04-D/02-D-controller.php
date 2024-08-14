<?php
include_once '../../0-includes/0-conn.php';
$id = $_POST['id'];
$table = $_POST['table'];
$sql =  "UPDATE $table SET status = 0 WHERE id = $id";
//echo $sql;
if ($conn->query($sql)) {
    //echo 'guardado con exito, query utilizado: ' . $sql;
    $id = 200;
    $post_data = array(
        'statusCode' => 200,
        'estado' => true,
        'mensaje' => "Registro Eliminado con exito",
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
