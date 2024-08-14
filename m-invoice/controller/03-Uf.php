<?php
include_once '../../0-includes/0-conn.php';
$id = $_POST['id'];
$table = $_POST['table'];
$tipoFactura = $_POST['tipoFactura'];




if ($tipoFactura == "") {
    $id = 400;
    $post_data = array(
        'statusCode' => 201,
        'estado' => false,
        'mensaje' => "vacio",
        'id' => $id
    );
} else {
    $sql =  "UPDATE $table SET tipoFactura = '$tipoFactura' WHERE id = $id";
    if ($conn->query($sql)) {
        $id = 200;
        $post_data = array(
            'statusCode' => 200,
            'estado' => true,
            'mensaje' => "tipo factura Actualizado con exito",
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
}


echo json_encode($post_data);
