<?php

  require '..includes/config.php';

  $message = '';
  $date = date('m/d/Y h:i:s a', time());
  if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['telefono']) && !empty($_POST['dni']) && !empty($_POST['name']) && !empty($_POST['surname'])) {
    $sql = "INSERT INTO usuarios (nombre, apellido, email, telefono, dni, contraseña, created_at) VALUES (:name, :surname, :email, :telefono, :dni, :passsword, $date)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':name', $_POST['name']);
    $stmt->bindParam(':surname', $_POST['surname']);
    $stmt->bindParam(':telefono', $_POST['telefono']);
    $stmt->bindParam(':dni', $_POST['dni']);
    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>