<?php
session_start();
include '0-includes/0-conn.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $query = $conn->query($sql);
    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'usuario no registado';
    } else {
        $row = $query->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['id'];            
        } else {
            $_SESSION['error'] = 'Nombre de usuario o contraseña incorrectos por favor verificar de nuevo !!!';            
        }
    }
} else {
    $_SESSION['error'] = 'introduce las credeciales primero';
}

header('location: index.php');
