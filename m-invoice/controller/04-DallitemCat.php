<?php
include_once '../../0-includes/0-conn.php';
$id = $_POST['id'];//factura id
$idCat = $_POST['idCat'];// categoria id
$table = $_POST['table'];//facturas
$table1 = $_POST['table1'];//facturas detalles


if($idCat==1){
    $sql =  "UPDATE $table SET cat1 = 0 WHERE id = $id";   
    $sql1 = "DELETE FROM $table1 WHERE description = $id and status = 1";//item tipo atencion = 1 

}

if($idCat==2){
    $sql =  "UPDATE $table SET cat2 = 0 WHERE id = $id";   
    $sql1 = "DELETE FROM $table1 WHERE description = $id and status = 0";//item medicamento atencion = 0 

}

if($idCat==3){
    $sql =  "UPDATE $table SET cat3 = 0 WHERE id = $id";   
    $sql1 = "DELETE FROM $table1 WHERE description = $id and status = 3";//item categoria atencion = 3

}

if($idCat==4){
    $sql =  "UPDATE $table SET cat4 = 0 WHERE id = $id";   
    $sql1 = "DELETE FROM $table1 WHERE description = $id and status = 4";//item categoria atencion = 3

}


if($idCat==5){
    $sql =  "UPDATE $table SET cat5 = 0 WHERE id = $id";   
    $sql1 = "DELETE FROM $table1 WHERE description = $id and status = 5";//item categoria atencion = 3

}


 //echo $sql;
if ($conn->query($sql)) {
    
    if ($conn->query($sql1)) {
        //echo 'guardado con exito, query utilizado: ' . $sql;
        $id = 200;    
        $post_data = array(
            'statusCode' => 200,
            'estado' => true,
            'mensaje' => "Registro Eliminado con exito",
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