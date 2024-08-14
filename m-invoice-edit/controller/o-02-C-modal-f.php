<?php
include_once '../../0-includes/0-conn.php';
if (isset($_POST['add'])) {
    $valor1 =  $_POST['description'];
    $valor2 =  $_POST['quantity'];
    $valor3 =  $_POST['price'];
    $sql =  "INSERT INTO modulo_base (description, quantity, price) VALUES ('$valor1', $valor2, $valor3)";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'guardado con exito';
    }else{
        $_SESSION['error'] = $conn->error. ' query utilizado: '. $sql ;   
    }
    $conn->close();
}else{
    $_SESSION['error'] . 'faltan campos';
}
header('location: ../index.php');