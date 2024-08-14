<?php
include_once '../../0-includes/0-conn.php';

// Check if all required fields are set
if(isset($_POST['table'], $_POST['id'])) {
    $table = $_POST['table'];
    $id = $_POST['id'];

    // Check if photo file is uploaded
    if(isset($_FILES['photo']['name']) && !empty($_FILES['photo']['name'])) {
        $filename = $_FILES['photo']['name'];
        $file_tmp = $_FILES['photo']['tmp_name'];

        // Move the uploaded file to the destination directory
        $destination = '../../recursos/img/' . $filename;
        if(move_uploaded_file($file_tmp, $destination)) {
            // Prepare SQL statement
            $sql = "UPDATE $table SET photo = ? WHERE id = ?";
            
            // Prepare and bind parameters
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $filename, $id);

            // Execute the statement
            if ($stmt->execute()) {
                $post_data = array(
                    'statusCode' => 200,
                    'estado' => true,
                    'mensaje' => "Guardado con éxito", //. sql: ".$sql." photo: ".$filename." id: ".$id,
                    'id' => $id
                );
            } else {
                $post_data = array(
                    'statusCode' => 201,
                    'estado' => false,
                    'mensaje' => "Error al actualizar: " . $stmt->error,
                    'id' => $id
                );
            }

            // Close statement
            $stmt->close();
        } else {
            // Error in moving the uploaded file
            $post_data = array(
                'statusCode' => 201,
                'estado' => false,
                'mensaje' => "Error al subir el archivo.",
                'id' => $id
            );
        }
    } else {
        // No file uploaded, send a message
        $post_data = array(
            'statusCode' => 201,
            'estado' => false,
            'mensaje' => "No se ha seleccionado ningún archivo.",
            'id' => $id
        );
    }
} else {
    // Incomplete data received
    $post_data = array(
        'statusCode' => 400,
        'estado' => false,
        'mensaje' => "Datos incompletos recibidos.",
        'id' => 0
    );
}

// Close connection
$conn->close();

// Output JSON response
echo json_encode($post_data);
?>
