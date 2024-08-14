<?php

include_once '../../0-includes/0-conn.php';

if (isset($_POST['delete'])) {    
    $id =  $_POST['id'];
    $table =  $_POST['table'];    
    
    $sql =  "UPDATE $table SET status = 0 WHERE id = $id";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Guardado con Exito';
        echo 'Guardado con Exito';
    }else{
        $_SESSION['Error'] = $conn->error. 'Error: '. $sql ;   
        echo  'Error: '. $sql ; 
    }
    
    $conn->close();

}else
    $_SESSION['Erro'] . 'Faltan Campos';
    echo 'Error Faltan Campos';

header('location: ../index.php');