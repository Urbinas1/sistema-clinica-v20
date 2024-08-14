<?php
include_once '../../0-includes/0-conn.php';
if (isset($_POST['add'])) {
    $table =  $_POST['table'];    
    $description =  $_POST['description'];  
    $quantity =  $_POST['quantity'];  
    $price =  $_POST['price'];

    $sql =  "INSERT INTO $table (description, quantity, price) VALUES ('$description', '$quantity','$price')";
    if ($conn->query($sql)) {
        //$_SESSION['success'] = 'guardado con exito';
        echo 'Guardado con Exito: '. $sql ; 
    }else{
        //$_SESSION['error'] = $conn->error. ' query utilizado: '. $sql ;   
        echo 'Error: '. $sql ; 
    }
    $conn->close();
}else{
    //$_SESSION['error'] . 'faltan campos';
    echo 'Faltan Campos';
}
header('location: ../index.php');