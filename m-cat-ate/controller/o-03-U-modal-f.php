<?php
include_once '../../0-includes/0-conn.php';
if (isset($_POST['update'])) {    
    $id =  $_POST['id'];
    $table =  $_POST['table'];
    
    $description =  $_POST['description'];    
    $price =  $_POST['price'];
    
    $sql =  "UPDATE $table SET description = '$description', price = $price WHERE id = $id";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Guardado con Exito';
        echo 'Guardado con Exito';
    }else{
        $_SESSION['Error'] = $conn->error. 'Error: '. $sql ;   
        echo  'Error: '. $sql ;     
    }
    
    $conn->close();

}else{
    $_SESSION['Error'] . 'Faltan Campos';
    echo 'Error Faltan Campos';
}

header('location: ../index.php');