<?php
include_once '../../0-includes/0-conn.php';
$table = $_POST['table'];
$description = $_POST['description'];
$poliza = $_POST['poliza'];
$certificado = $_POST['certificado'];
$quantity =  $_POST['quantity'];

$username =  $_POST['username'];
$password = $_POST['password'];
$pass_cifrado = password_hash($password, PASSWORD_DEFAULT);

$filename = $_FILES['photo']['name'];
if (!empty($filename)) {
    move_uploaded_file($_FILES['photo']['tmp_name'], '../../recursos/img/' . $filename);
}

$sql =  "INSERT INTO $table (description, quantity, poliza, certificado,photo, username, password) VALUES ('$description', '$quantity', '$poliza', '$certificado',   '$filename', '$username', '$pass_cifrado')";
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
