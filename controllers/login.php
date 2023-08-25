<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: ../views/log-in.php');
  }
  require '../includes/config.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM Usuarios WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: ../views/log-in.php");
      $message = 'Estas credenciales no coinciden.';
    }
  }

?>