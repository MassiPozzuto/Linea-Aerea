<?php

require '../includes/config.php';

session_start();

if (isset($_SESSION['user_id'])) {
  header('Location: ../home.php'); 
}

if (!empty($_POST)) {
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

$page = "Inicio";
$section = "home";
require_once "../views/access/layout.php";
