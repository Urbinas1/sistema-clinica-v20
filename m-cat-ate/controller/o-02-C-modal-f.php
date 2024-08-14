<?php
include_once '../../0-includes/0-conn.php';
if (isset($_POST['add'])) {
    $table =  $_POST['table'];    
    $valor1 =  $_POST['description'];    
    $valor3 =  $_POST['price'];
    $sql =  "INSERT INTO $table (description,  price) VALUES ('$valor1',  '$valor3')";
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