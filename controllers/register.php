<?php

require '../includes/config.php';

$message = '';
$date = date('m/d/Y h:i:s a', time());

if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['telefono']) && !empty($_POST['dni']) && !empty($_POST['name']) && !empty($_POST['surname'])) {
    $sql = "INSERT INTO usuarios (nombre, apellido, email, telefono, dni, contraseña, created_at) VALUES (:name, :surname, :email, :telefono, :dni, :password, '$date')";
    
    $stmt = sqlsrv_prepare($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $telefono = $_POST['telefono'];
    $dni = $_POST['dni'];

    $stmt = sqlsrv_prepare($conn, $sql, array(&$name, &$surname, &$email, &$telefono, &$dni, &$password));


    if (sqlsrv_execute($stmt)) {
        $message = 'Usuario creado exitosamente';
    } else {
        $message = 'Hubo un problema al crear tu cuenta';
        die(print_r(sqlsrv_errors(), true));
    }
} else {
    $message = 'Por favor, completa todos los campos';
}

?>