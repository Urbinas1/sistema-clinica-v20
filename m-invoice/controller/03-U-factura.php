<?php
include_once '../../0-includes/0-conn.php';
$id = $_POST['id'];
$table = $_POST['table'];


$sql =  "UPDATE $table SET status = 0 WHERE id = $id";



if ($conn->query($sql)) {


    $sql2 =  "INSERT INTO $table (description) VALUES ('1')";
    if ($conn->query($sql2)) {       

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
            'mensaje' => "error: " + $conn->error + ' sql utilizado: ' + $sql,
            'id' => $id
        );
    }


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
