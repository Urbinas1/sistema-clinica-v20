<?php
include_once '../../0-includes/0-conn.php';
$id = $_POST['id'];
$table = $_POST['table'];
$idCat = $_POST['idCat'];

if($idCat==1){
    $sql =  "UPDATE $table SET cat1 = 1 WHERE id = $id";   
}

if($idCat==2){
    $sql =  "UPDATE $table SET cat2 = 1 WHERE id = $id";   
}

if($idCat==3){
    $sql =  "UPDATE $table SET cat3 = 1 WHERE id = $id";   
}

if($idCat==4){
    $sql =  "UPDATE $table SET cat4 = 1 WHERE id = $id";   
}

if($idCat==5){
    $sql =  "UPDATE $table SET cat5 = 1 WHERE id = $id";   
}


    if ($conn->query($sql)) {
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
            'mensaje' => "error: " + $conn->error + ' sql utilizado: ' + $sql,
            'id' => $id
        );
    }
    $conn->close();



echo json_encode($post_data);
