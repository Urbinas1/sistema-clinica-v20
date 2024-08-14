<?php
include_once '../../0-includes/0-conn.php';
$table = $_POST['table'];
$description = $_POST['description'];
$poliza = $_POST['poliza'];
$certificado = $_POST['certificado'];
$quantity =  2;

 $sql =  "INSERT INTO $table (description, quantity, poliza, certificado) VALUES ('$description', '$quantity', '$poliza', '$certificado')";
 //echo $sql;

if ($conn->query($sql)) {
    //echo 'guardado con exito, query utilizado: ' . $sql;
    $id = 200;    
    $post_data = array(
        'statusCode' => 200,
        'estado' => true,
        'mensaje' => "Guardado con Exito",
        'id' => $id
    );
} else {
    $id = 400;
    $post_data = array(
        'statusCode' => 201,
        'estado' => false,
        'mensaje' => "Error: " + $conn->error,
        'id' => $id
    );
}
$conn->close();
echo json_encode($post_data);