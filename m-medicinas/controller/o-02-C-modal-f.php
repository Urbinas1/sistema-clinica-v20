<?php
include_once '../../0-includes/0-conn.php';
if (isset($_POST['add'])) {
    $table =  $_POST['table'];    
    $Description =  $_POST['Description'];    
    $Price =  $_POST['Price'];
    $Quantity =  $_POST['Quantity'];
    $sql =  "INSERT INTO $table (Description,  Price, Quantity) VALUES ('$Description', '$Price', '$Quantity')";
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