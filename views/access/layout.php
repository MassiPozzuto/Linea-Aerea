<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
  <title><?php echo $page; ?> • Racedo Airways</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Viex Inc.">

  <link rel="icon" sizes="192x192" href="">

  <!-- FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  <!-- BOOTSTRAP -->
  <!--<script src="../js/bootstrap.bundle.js"></script>-->
  <link href="../css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- JQUERY -->
  <script src="../js/jquery.min.js"></script>
  <!-- CSS -->
  <link href="../css/main.css" rel="stylesheet">
  <link href="../css/<?php echo $section ?>.css" rel="stylesheet">

</head>

<body>
  <!-- Empieza el contenido especifico -->
    <?php require_once($section . ".php") ?>
  <!-- Termina el contenido especifico -->

</body>

</html>