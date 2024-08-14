<?php
include_once '../../0-includes/0-conn.php';
$id = $_POST['id'];
$table = $_POST['table'];
$description = $_POST['description'];
$seguro = $_POST['seguro'];
$poliza = $_POST['poliza'];
$rtn = $_POST['rtn'];
$certificado = $_POST['certificado'];
$docId = $_POST['docId'];
$quantity =  3;

 $sql =  "UPDATE $table SET description = '$description', quantity = '$quantity', seguro = '$seguro', poliza = '$poliza', rtn = '$rtn', docId = '$docId', certificado = '$certificado' WHERE id = $id";
 //echo $sql;

if ($conn->query($sql)) {
    //echo 'guardado con exito, query utilizado: ' . $sql;
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