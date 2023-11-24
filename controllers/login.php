<?php

require '../includes/config.php';

// Iniciar sesión si ya hay un usuario autenticado
if (isset($_SESSION['user_id'])) {
  header('Location: ../home.php'); 
  exit();
}

// Verificar si se ha enviado el formulario de inicio de sesión
if (!empty($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT id, email, password FROM Usuarios WHERE email = ?";
  $params = array($email);

  $stmt = sqlsrv_prepare($conn, $query, $params);
  if ($stmt === false) {
      die(print_r(sqlsrv_errors(), true));
  }

  if (sqlsrv_execute($stmt)) {
      // Fetch the results
      $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

      if ($row !== false && password_verify($password, $row['password'])) {
          $_SESSION['user_id'] = $row['id'];
          header("Location: ../login.php");
      } else {
          $message = 'Estas credenciales no coinciden.';
      }
  } else {
      die(print_r(sqlsrv_errors(), true));
  }
}

// Página de inicio de sesión
$page = "Iniciar sesión";
$section = "login";
require_once "../views/access/layout.php";