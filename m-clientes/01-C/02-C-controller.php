<?php
include_once '../../0-includes/0-conn.php';
$table = $_POST['table'];
$description = $_POST['description'];
$seguro = $_POST['seguro'];
$poliza = $_POST['poliza'];
$rtn = $_POST['rtn'];
$certificado = $_POST['certificado'];
$docId = $_POST['docId'];
$quantity =  3;

 $sql =  "INSERT INTO $table (description,seguro, quantity, poliza,rtn, certificado,docId) VALUES ('$description', '$seguro','$quantity', '$poliza','$rtn', '$certificado', '$docId')";
 //echo $sql;

if ($conn->query($sql)) {
    //echo 'guardado con exito, query utilizado: ' . $sql;
    $id = 200;    
    $post_data = array(
        'statusCode' => 200,
        'estado' => true,
        'mensaje' => "guardado con exito",
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